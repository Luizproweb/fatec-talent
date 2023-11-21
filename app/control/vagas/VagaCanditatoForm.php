<?php

class VagaCanditatoForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'u316696823_fatec_talent';
    private static $activeRecord = 'Vaga';
    private static $primaryKey = 'id';
    private static $formName = 'form_VagaForm';

    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        parent::__construct();

        if(!empty($param['target_container']))
        {
            $this->adianti_target_container = $param['target_container'];
        }

        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);
        // define the form title
        $this->form->setFormTitle("Cadastro de Vaga");


        $pessoa_id = new TDBCombo('pessoa_id', 'u316696823_fatec_talent', 'Pessoa', 'id', '{nome}','id asc'  );
        $id = new TEntry('id');
        $periodo_ini = new TDateTime('periodo_ini');
        $periodo_fim = new TDateTime('periodo_fim');
        $salario = new TNumeric('salario', '2', ',', '.' );
        $regime_trabalho_id = new TDBCombo('regime_trabalho_id', 'u316696823_fatec_talent', 'RegimeTrabalho', 'id', '{codigo} -  {descricao}','id asc'  );
        $modelo_trabalho_id = new TDBCombo('modelo_trabalho_id', 'u316696823_fatec_talent', 'ModeloTrabalho', 'id', '{codigo} - {descricao}','id asc'  );
        $curso_id = new TDBCombo('curso_id', 'u316696823_fatec_talent', 'Curso', 'id', '{codigo} - {descricao}','id asc'  );
        $observacao = new TText('observacao');

        $periodo_ini->addValidation("Período Inicial ", new TRequiredValidator()); 
        $periodo_fim->addValidation("Período Final ", new TRequiredValidator()); 
        $regime_trabalho_id->addValidation("Regime trabalho id", new TRequiredValidator()); 
        $modelo_trabalho_id->addValidation("Modelo trabalho id", new TRequiredValidator()); 
        $observacao->addValidation("Observação ", new TRequiredValidator()); 

        $periodo_ini->setMask('dd/mm/yyyy hh:ii');
        $periodo_fim->setMask('dd/mm/yyyy hh:ii');

        $periodo_ini->setDatabaseMask('yyyy-mm-dd hh:ii');
        $periodo_fim->setDatabaseMask('yyyy-mm-dd hh:ii');

        $curso_id->enableSearch();
        $pessoa_id->enableSearch();
        $regime_trabalho_id->enableSearch();
        $modelo_trabalho_id->enableSearch();

        $id->setSize(100);
        $salario->setSize('100%');
        $curso_id->setSize('100%');
        $pessoa_id->setSize('100%');
        $periodo_ini->setSize('100%');
        $periodo_fim->setSize('100%');
        $observacao->setSize('100%', 250);
        $regime_trabalho_id->setSize('100%');
        $modelo_trabalho_id->setSize('100%');

        $id->setEditable(false);
        $salario->setEditable(false);
        $curso_id->setEditable(false);
        $pessoa_id->setEditable(false);
        $observacao->setEditable(false);
        $periodo_ini->setEditable(false);
        $periodo_fim->setEditable(false);
        $regime_trabalho_id->setEditable(false);
        $modelo_trabalho_id->setEditable(false);

        $row1 = $this->form->addFields([new TLabel("Empresa:", null, '14px', null),$pessoa_id]);
        $row1->layout = [' col-sm-12'];

        $row2 = $this->form->addFields([new TLabel("Nº Vaga:", null, '14px', null, '100%'),$id],[new TLabel("Período Inicial :", '#000000', '14px', null, '100%'),$periodo_ini],[new TLabel("Período Final :", '#000000', '14px', null, '100%'),$periodo_fim],[new TLabel("Salário :", null, '14px', null, '100%'),$salario]);
        $row2->layout = [' col-sm-3','col-sm-3','col-sm-3','col-sm-3'];

        $row3 = $this->form->addFields([new TLabel("Regime de Trabalho:", '#000000', '14px', null, '100%'),$regime_trabalho_id],[new TLabel("Modelo de Trabalho:", '#000000', '14px', null, '100%'),$modelo_trabalho_id],[new TLabel("Curso:", null, '14px', null),$curso_id]);
        $row3->layout = [' col-sm-4',' col-sm-4',' col-sm-4'];

        $row4 = $this->form->addFields([new TLabel("Observações da Vaga:", '#000000', '14px', null, '100%'),$observacao]);
        $row4->layout = [' col-sm-12'];

        // create the form actions
        $btn_oncandidatarvaga = $this->form->addAction("Candidatar-se", new TAction([$this, 'onCandidatarVaga']), 'fas:paper-plane #FFFFFF');
        $this->btn_oncandidatarvaga = $btn_oncandidatarvaga;
        $btn_oncandidatarvaga->addStyleClass('btn-primary'); 

        $btn_onshow = $this->form->addAction("Voltar", new TAction(['VagaList', 'onShow']), 'fas:arrow-left #000000');
        $this->btn_onshow = $btn_onshow;

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        if(empty($param['target_container']))
        {
            $container->add(TBreadCrumb::create(["Vagas","Candidatar a Vaga"]));
        }
        $container->add($this->form);

        parent::add($container);

    }

    public function onCandidatarVaga($param = null) 
    {
        try 
        {
            //code here
            TTransaction::open(self::$database);

            $key = $param['id'];
            $usuario_id = TSession::getValue('userid');
            $vaga = Vaga::find($key);

            if($usuario_id)
            {
                $cadastro = Pessoa::where('system_user', '=', $usuario_id )->load();

                $cadastro_id = $cadastro[0]->id;

                $papel_empresa = PessoaPapel::where('pessoa_id', '=', $cadastro_id)->first();

                if($papel_empresa->papel_id == Papel::EMPRESA)
                {
                    throw new Exception('Apenas candidatos podem realizar inscrições para vagas de emprego.');
                }

                if(empty($cadastro[0]->anexo_curriculo))
                {
                    throw new Exception('Cadastre seu currículo para seguir com a candidatura.');
                }

                if($vaga->ativo == 'N')
                {
                    throw new Exception('Você não pode se candidatar para uma vaga inativada.');
                }

                $pessoa_vaga = PessoaVaga::getByPessoaVaga($cadastro_id, $param['id']);

                if($pessoa_vaga)
                {
                     throw new Exception('Você já se candidatou para esta vaga.');
                }

                if($cadastro)
                {
                    $pessoa_vaga = new PessoaVaga();
                    $pessoa_vaga->vaga_id = $vaga->id;
                    $pessoa_vaga->pessoa_id = $cadastro[0]->id;
                    $pessoa_vaga->store();

                    VagaService::onSendEmailVaga($vaga, $cadastro[0]);
                }
                else
                {
                    throw new Exception('Não foi possível localizar o cadastro.');
                }
            }

            $action = new TAction([VagaList::class, 'onReload']);

            new TMessage ('info', 'Candidatura realizada com Sucesso', $action);

            TTransaction::close();

        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

    public function onEdit( $param )
    {
        try
        {
            if (isset($param['key']))
            {
                $key = $param['key'];  // get the parameter $key
                TTransaction::open(self::$database); // open a transaction

                $object = new Vaga($key); // instantiates the Active Record 

                $this->form->setData($object); // fill the form 

                TTransaction::close(); // close the transaction 
            }
            else
            {
                $this->form->clear();
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }

    /**
     * Clear form data
     * @param $param Request
     */
    public function onClear( $param )
    {
        $this->form->clear(true);

    }

    public function onShow($param = null)
    {

    } 

    public static function getFormName()
    {
        return self::$formName;
    }

}

