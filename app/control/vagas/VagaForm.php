<?php

class VagaForm extends TPage
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


        $id = new TEntry('id');
        $pessoa_id = new TDBCombo('pessoa_id', 'u316696823_fatec_talent', 'Pessoa', 'id', '{nome}','id asc'  );
        $email = new TEntry('email');
        $periodo_ini = new TDate('periodo_ini');
        $periodo_fim = new TDate('periodo_fim');
        $salario = new TNumeric('salario', '2', ',', '.' );
        $ativo = new TRadioGroup('ativo');
        $regime_trabalho_id = new TDBCombo('regime_trabalho_id', 'u316696823_fatec_talent', 'RegimeTrabalho', 'id', '{codigo} - {descricao}','id asc'  );
        $modelo_trabalho_id = new TDBCombo('modelo_trabalho_id', 'u316696823_fatec_talent', 'ModeloTrabalho', 'id', '{codigo} - {descricao}','id asc'  );
        $curso_id = new TDBCombo('curso_id', 'u316696823_fatec_talent', 'Curso', 'id', '{codigo} - {descricao}','id asc'  );
        $observacao = new TText('observacao');

        $pessoa_id->addValidation("Pessoa papel id", new TRequiredValidator()); 
        $email->addValidation("E-mail ", new TRequiredValidator()); 
        $periodo_ini->addValidation("Período Inicial ", new TRequiredValidator()); 
        $periodo_fim->addValidation("Período Final ", new TRequiredValidator()); 
        $ativo->addValidation("Ativo ", new TRequiredValidator()); 
        $regime_trabalho_id->addValidation("Regime de Trabalho", new TRequiredValidator()); 
        $modelo_trabalho_id->addValidation("Modelo trabalho id", new TRequiredValidator()); 
        $curso_id->addValidation("Curso id", new TRequiredValidator()); 
        $observacao->addValidation("Observação ", new TRequiredValidator()); 
        $observacao->addValidation("Observações da Vaga", new TMinLengthValidator(), ["30"]); 

        $ativo->addItems(["S"=>"Sim","N"=>"Não"]);
        $ativo->setLayout('horizontal');
        $ativo->setValue('S');
        $ativo->setUseButton();
        $periodo_ini->setMask('dd/mm/yyyy');
        $periodo_fim->setMask('dd/mm/yyyy');

        $periodo_ini->setDatabaseMask('yyyy-mm-dd');
        $periodo_fim->setDatabaseMask('yyyy-mm-dd');

        $id->setEditable(false);
        $email->setEditable(false);
        $pessoa_id->setEditable(false);

        $curso_id->enableSearch();
        $pessoa_id->enableSearch();
        $regime_trabalho_id->enableSearch();
        $modelo_trabalho_id->enableSearch();

        $id->setSize(100);
        $email->setSize('100%');
        $ativo->setSize('100%');
        $salario->setSize('100%');
        $curso_id->setSize('100%');
        $pessoa_id->setSize('100%');
        $periodo_ini->setSize('100%');
        $periodo_fim->setSize('100%');
        $observacao->setSize('100%', 100);
        $regime_trabalho_id->setSize('100%');
        $modelo_trabalho_id->setSize('100%');


        TTransaction::open(self::$database);
        $empresa = Pessoa::where('system_user', '=', TSession::getValue('userid'))->first();
        $usuario_sistema = SystemUsers::where('id', '=', TSession::getValue('userid'))->first();
        TTransaction::close();

        if(!empty($empresa->id))
        {
            $pessoa_id->setValue($empresa->id);
            $email->setValue($empresa->email);
        }

        if ($usuario_sistema->id == SystemUsers::ADMIN_USER)
        {
            $pessoa_id->setEditable(true);
            $email->setEditable(true);
        }
        else
        {
            $pessoa_id->setEditable(false);
            $email->setEditable(false);
        }

        $row1 = $this->form->addFields([new TLabel("Nº Vaga", null, '14px', null, '100%'),$id],[new TLabel("Empresa:", '#ff0000', '14px', null, '100%'),$pessoa_id],[new TLabel("E-mail :", '#ff0000', '14px', null, '100%'),$email]);
        $row1->layout = [' col-sm-2',' col-sm-4','col-sm-6'];

        $row2 = $this->form->addFields([new TLabel("Período Inicial :", '#ff0000', '14px', null, '100%'),$periodo_ini],[new TLabel("Período Final :", '#ff0000', '14px', null, '100%'),$periodo_fim],[new TLabel("Salário :", null, '14px', null, '100%'),$salario],[new TLabel("Ativo :", '#ff0000', '14px', null, '100%'),$ativo]);
        $row2->layout = [' col-sm-3',' col-sm-3',' col-sm-3',' col-sm-3'];

        $row3 = $this->form->addFields([new TLabel("Regime de Trabalho:", '#ff0000', '14px', null, '100%'),$regime_trabalho_id],[new TLabel("Modelo de Trabalho:", '#ff0000', '14px', null, '100%'),$modelo_trabalho_id],[new TLabel("Curso:", '#ff0000', '14px', null, '100%'),$curso_id]);
        $row3->layout = [' col-sm-4',' col-sm-4',' col-sm-4'];

        $row4 = $this->form->addFields([new TLabel("Observações da Vaga:", '#ff0000', '14px', null, '100%'),$observacao]);
        $row4->layout = [' col-sm-12'];

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave']), 'fas:save #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');
        $this->btn_onclear = $btn_onclear;

        $btn_onshow = $this->form->addAction("Voltar", new TAction(['VagaList', 'onShow']), 'fas:arrow-left #000000');
        $this->btn_onshow = $btn_onshow;

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        if(empty($param['target_container']))
        {
            $container->add(TBreadCrumb::create(["Vagas","Cadastro de Vaga"]));
        }
        $container->add($this->form);

        parent::add($container);

    }

    public function onSave($param = null) 
    {
        try
        {
            TTransaction::open(self::$database); // open a transaction

            $messageAction = null;

            $this->form->validate(); // validate form data

            $object = new Vaga(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            if($object->salario < 100)
            {
                throw new Exception('Informe um Salário superior a R$ 100,00');
            }

            $dataAtual = new DateTime();
            $stringDataAtual = $dataAtual->format('Y-m-d');

            if($object->periodo_ini < $stringDataAtual)
            {
                throw new Exception('O período inicial é menor que a data atual.');
            }

            if($object->periodo_fim < $object->periodo_ini)
            {
                throw new Exception('O Período Final é menor que o Período Inicial.');
            }

            $object->store(); // save the object 

            $loadPageParam = [];

            if(!empty($param['target_container']))
            {
                $loadPageParam['target_container'] = $param['target_container'];
            }

            // get the generated {PRIMARY_KEY}
            $data->id = $object->id; 

            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            TToast::show('success', "Registro salvo", 'topRight', 'far:check-circle');
            TApplication::loadPage('VagaList', 'onShow', $loadPageParam); 

        }
        catch (Exception $e) // in case of exception
        {
            //</catchAutoCode> 

            new TMessage('error', $e->getMessage()); // shows the exception error message
            $this->form->setData( $this->form->getData() ); // keep form data
            TTransaction::rollback(); // undo all pending operations
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

    public static function onYes($param = null) 
    {
        try 
        {
            //code here
        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

    public static function onNo($param = null) 
    {
        try 
        {
            //code here
        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

}

