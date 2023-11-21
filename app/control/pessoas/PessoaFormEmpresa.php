<?php

class PessoaFormEmpresa extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'u316696823_fatec_talent';
    private static $activeRecord = 'Pessoa';
    private static $primaryKey = 'id';
    private static $formName = 'form_PessoaForm';

    use BuilderMasterDetailTrait;

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
        $this->form->setFormTitle("Cadastro de Usuário");


        $id = new TEntry('id');
        $system_user = new TDBCombo('system_user', 'u316696823_fatec_talent', 'SystemUsers', 'id', '{name}','name asc'  );
        $ativo = new TRadioGroup('ativo');
        $documento = new TEntry('documento');
        $fone = new TEntry('fone');
        $celular = new TEntry('celular');
        $email = new TEntry('email');
        $site = new TEntry('site');
        $observacao = new TText('observacao');
        $endereco_pessoa_cep = new TEntry('endereco_pessoa_cep');
        $endereco_pessoa_endereco = new TEntry('endereco_pessoa_endereco');
        $endereco_pessoa_id = new THidden('endereco_pessoa_id');
        $endereco_pessoa_numero = new TEntry('endereco_pessoa_numero');
        $endereco_pessoa_bairro = new TEntry('endereco_pessoa_bairro');
        $endereco_pessoa_complemento = new TEntry('endereco_pessoa_complemento');
        $endereco_pessoa_cidade_id = new TDBCombo('endereco_pessoa_cidade_id', 'u316696823_fatec_talent', 'Cidade', 'id', '{nome}','id asc'  );
        $estado_id = new TDBCombo('estado_id', 'u316696823_fatec_talent', 'Estado', 'id', '{nome}','nome asc'  );
        $endereco_pessoa_tipo_endereco_id = new TDBCombo('endereco_pessoa_tipo_endereco_id', 'u316696823_fatec_talent', 'TipoEndereco', 'id', '{descricao}','id asc'  );
        $button_adicionar_endereco_pessoa = new TButton('button_adicionar_endereco_pessoa');
        $button_buscar_dados_da_receita = new TButton('button_buscar_dados_da_receita');
        $ramo_atividade_pessoa_nome = new TEntry('ramo_atividade_pessoa_nome');
        $ramo_atividade_pessoa_id = new THidden('ramo_atividade_pessoa_id');
        $ramo_atividade_pessoa_nome_fantasia = new TEntry('ramo_atividade_pessoa_nome_fantasia');
        $ramo_atividade_pessoa_unidade = new TEntry('ramo_atividade_pessoa_unidade');
        $ramo_atividade_pessoa_regime_tributario = new TEntry('ramo_atividade_pessoa_regime_tributario');
        $ramo_atividade_pessoa_dt_inicio_atividade = new TDate('ramo_atividade_pessoa_dt_inicio_atividade');
        $ramo_atividade_pessoa_situacao_cadastral = new TEntry('ramo_atividade_pessoa_situacao_cadastral');
        $ramo_atividade_pessoa_atividade_principal = new TEntry('ramo_atividade_pessoa_atividade_principal');
        $ramo_atividade_pessoa_atividade_secundaria = new TEntry('ramo_atividade_pessoa_atividade_secundaria');
        $ramo_atividade_pessoa_inscricao_estadual = new TEntry('ramo_atividade_pessoa_inscricao_estadual');
        $ramo_atividade_pessoa_inscricao_ativa = new TRadioGroup('ramo_atividade_pessoa_inscricao_ativa');
        $button_adicionar_ramo_atividade_pessoa = new TButton('button_adicionar_ramo_atividade_pessoa');

        $endereco_pessoa_cep->setExitAction(new TAction([$this,'onChangeCEP']));

        $system_user->addValidation("System user", new TRequiredValidator()); 
        $ativo->addValidation("Ativo ", new TRequiredValidator()); 
        $documento->addValidation("Documento ", new TRequiredValidator()); 
        $documento->addValidation("CNPJ", new TCNPJValidator(), []); 
        $email->addValidation("E-mail", new TEmailValidator(), []); 

        $ativo->setValue('S');
        $ramo_atividade_pessoa_dt_inicio_atividade->setDatabaseMask('yyyy-mm-dd');
        $ativo->addItems(["Y"=>"Sim","N"=>"Não"]);
        $ramo_atividade_pessoa_inscricao_ativa->addItems(["1"=>"Sim","2"=>"Não"]);

        $ativo->setLayout('horizontal');
        $ramo_atividade_pessoa_inscricao_ativa->setLayout('horizontal');

        $ativo->setUseButton();
        $ramo_atividade_pessoa_inscricao_ativa->setUseButton();

        $endereco_pessoa_numero->setMaxLength(10);
        $ramo_atividade_pessoa_situacao_cadastral->setMaxLength(1);

        $fone->setMask('(99)9999-9999');
        $celular->setMask('(99)99999-9999');
        $ramo_atividade_pessoa_dt_inicio_atividade->setMask('dd/mm/yyyy');

        $button_adicionar_endereco_pessoa->setAction(new TAction([$this, 'onAddDetailEnderecoPessoa'],['static' => 1]), "Adicionar");
        $button_buscar_dados_da_receita->setAction(new TAction(['PessoaFormEmpresa', 'onBuscaDadosReceita']), "Buscar Dados da Receita");
        $button_adicionar_ramo_atividade_pessoa->setAction(new TAction([$this, 'onAddDetailRamoAtividadePessoa'],['static' => 1]), "Adicionar");

        $button_buscar_dados_da_receita->addStyleClass('btn-primary');
        $button_adicionar_endereco_pessoa->addStyleClass('btn-default');
        $button_adicionar_ramo_atividade_pessoa->addStyleClass('btn-default');

        $button_adicionar_endereco_pessoa->setImage('fas:plus #2ecc71');
        $button_buscar_dados_da_receita->setImage('fas:search #FFFFFF');
        $button_adicionar_ramo_atividade_pessoa->setImage('fas:plus #2ecc71');

        $estado_id->enableSearch();
        $system_user->enableSearch();
        $endereco_pessoa_cidade_id->enableSearch();
        $endereco_pessoa_tipo_endereco_id->enableSearch();

        $id->setEditable(false);
        $system_user->setEditable(false);
        $ramo_atividade_pessoa_nome->setEditable(false);
        $ramo_atividade_pessoa_unidade->setEditable(false);
        $ramo_atividade_pessoa_nome_fantasia->setEditable(false);
        $ramo_atividade_pessoa_inscricao_ativa->setEditable(false);
        $ramo_atividade_pessoa_regime_tributario->setEditable(false);
        $ramo_atividade_pessoa_situacao_cadastral->setEditable(false);
        $ramo_atividade_pessoa_inscricao_estadual->setEditable(false);
        $ramo_atividade_pessoa_dt_inicio_atividade->setEditable(false);
        $ramo_atividade_pessoa_atividade_principal->setEditable(false);
        $ramo_atividade_pessoa_atividade_secundaria->setEditable(false);

        $id->setSize(100);
        $fone->setSize('100%');
        $site->setSize('100%');
        $ativo->setSize('100%');
        $email->setSize('100%');
        $celular->setSize('100%');
        $documento->setSize('100%');
        $estado_id->setSize('100%');
        $system_user->setSize('100%');
        $observacao->setSize('100%', 70);
        $endereco_pessoa_id->setSize(200);
        $endereco_pessoa_cep->setSize('100%');
        $ramo_atividade_pessoa_id->setSize(200);
        $endereco_pessoa_numero->setSize('100%');
        $endereco_pessoa_bairro->setSize('100%');
        $endereco_pessoa_endereco->setSize('100%');
        $endereco_pessoa_cidade_id->setSize('100%');
        $ramo_atividade_pessoa_nome->setSize('100%');
        $endereco_pessoa_complemento->setSize('100%');
        $ramo_atividade_pessoa_unidade->setSize('100%');
        $endereco_pessoa_tipo_endereco_id->setSize('100%');
        $ramo_atividade_pessoa_nome_fantasia->setSize('100%');
        $ramo_atividade_pessoa_inscricao_ativa->setSize('100%');
        $ramo_atividade_pessoa_regime_tributario->setSize('100%');
        $ramo_atividade_pessoa_situacao_cadastral->setSize('100%');
        $ramo_atividade_pessoa_inscricao_estadual->setSize('100%');
        $ramo_atividade_pessoa_dt_inicio_atividade->setSize('100%');
        $ramo_atividade_pessoa_atividade_principal->setSize('100%');
        $ramo_atividade_pessoa_atividade_secundaria->setSize('100%');

        $button_adicionar_endereco_pessoa->id = '6543bb62aba83';
        $button_adicionar_ramo_atividade_pessoa->id = '654d91050be56';

        $cadastro_pessoa = new BootstrapFormBuilder('cadastro_pessoa');
        $this->cadastro_pessoa = $cadastro_pessoa;
        $cadastro_pessoa->setProperty('style', 'border:none; box-shadow:none;');

        $cadastro_pessoa->appendPage("Dados Gerais");

        $cadastro_pessoa->addFields([new THidden('current_tab_cadastro_pessoa')]);
        $cadastro_pessoa->setTabFunction("$('[name=current_tab_cadastro_pessoa]').val($(this).attr('data-current_page'));");

        $row1 = $cadastro_pessoa->addFields([new TLabel("Id:", null, '14px', null, '100%'),$id],[new TLabel("Usuário do Sistema:", '#000000', '14px', null, '100%'),$system_user],[new TLabel("Ativo :", '#ff0000', '14px', null, '100%'),$ativo]);
        $row1->layout = ['col-sm-2','col-sm-5','col-sm-3'];

        $row2 = $cadastro_pessoa->addFields([new TLabel("CPF/CNPJ:", '#000000', '14px', null, '100%'),$documento],[new TLabel("Telefone :", null, '14px', null, '100%'),$fone],[new TLabel("Celular :", null, '14px', null, '100%'),$celular]);
        $row2->layout = ['col-sm-4','col-sm-4','col-sm-4'];

        $row3 = $cadastro_pessoa->addFields([new TLabel("E-mail:", null, '14px', null, '100%'),$email],[new TLabel("Site :", null, '14px', null, '100%'),$site]);
        $row3->layout = [' col-sm-6','col-sm-6'];

        $row4 = $cadastro_pessoa->addFields([new TLabel("Observação :", null, '14px', null, '100%'),$observacao]);
        $row4->layout = [' col-sm-12'];

        $cadastro_pessoa->appendPage("Endereço");

        $this->detailFormEnderecoPessoa = new BootstrapFormBuilder('detailFormEnderecoPessoa');
        $this->detailFormEnderecoPessoa->setProperty('style', 'border:none; box-shadow:none; width:100%;');

        $this->detailFormEnderecoPessoa->setProperty('class', 'form-horizontal builder-detail-form');

        $row5 = $this->detailFormEnderecoPessoa->addFields([new TLabel("CEP :", null, '14px', null, '100%'),$endereco_pessoa_cep]);
        $row5->layout = [' col-sm-3'];

        $row6 = $this->detailFormEnderecoPessoa->addFields([new TLabel("Endereço :", null, '14px', null, '100%'),$endereco_pessoa_endereco,$endereco_pessoa_id],[new TLabel("Número :", null, '14px', null, '100%'),$endereco_pessoa_numero],[new TLabel("Bairro :", null, '14px', null, '100%'),$endereco_pessoa_bairro]);
        $row6->layout = [' col-sm-6',' col-sm-2',' col-sm-4'];

        $row7 = $this->detailFormEnderecoPessoa->addFields([new TLabel("Complemento :", null, '14px', null, '100%'),$endereco_pessoa_complemento],[new TLabel("Cidade:", '#161616', '14px', null, '100%'),$endereco_pessoa_cidade_id],[new TLabel("Estado:", null, '14px', null),$estado_id]);
        $row7->layout = ['col-sm-6',' col-sm-3',' col-sm-3'];

        $row8 = $this->detailFormEnderecoPessoa->addFields([new TLabel("Tipo de Endereço:", '#ff0000', '14px', null, '100%'),$endereco_pessoa_tipo_endereco_id]);
        $row8->layout = ['col-sm-6'];

        $row9 = $this->detailFormEnderecoPessoa->addFields([$button_adicionar_endereco_pessoa]);
        $row9->layout = [' col-sm-12'];

        $row10 = $this->detailFormEnderecoPessoa->addFields([new THidden('endereco_pessoa__row__id')]);
        $this->endereco_pessoa_criteria = new TCriteria();

        $this->endereco_pessoa_list = new BootstrapDatagridWrapper(new TDataGrid);
        $this->endereco_pessoa_list->disableHtmlConversion();;
        $this->endereco_pessoa_list->generateHiddenFields();
        $this->endereco_pessoa_list->setId('endereco_pessoa_list');

        $this->endereco_pessoa_list->style = 'width:100%';
        $this->endereco_pessoa_list->class .= ' table-bordered';

        $column_endereco_pessoa_tipo_endereco_descricao = new TDataGridColumn('{tipo_endereco->descricao}', "Tipo endereço", 'left');
        $column_endereco_pessoa_endereco = new TDataGridColumn('endereco', "Endereço", 'left');
        $column_endereco_pessoa_numero = new TDataGridColumn('numero', "Número", 'left');
        $column_endereco_pessoa_bairro = new TDataGridColumn('bairro', "Bairro", 'left');
        $column_endereco_pessoa_complemento = new TDataGridColumn('complemento', "Complemento", 'left');
        $column_endereco_pessoa_cidade_nome = new TDataGridColumn('{cidade->nome}', "Cidade id", 'left');
        $column_endereco_pessoa_cep = new TDataGridColumn('cep', "CEP", 'left');

        $column_endereco_pessoa__row__data = new TDataGridColumn('__row__data', '', 'center');
        $column_endereco_pessoa__row__data->setVisibility(false);

        $action_onEditDetailEndereco = new TDataGridAction(array('PessoaFormEmpresa', 'onEditDetailEndereco'));
        $action_onEditDetailEndereco->setUseButton(false);
        $action_onEditDetailEndereco->setButtonClass('btn btn-default btn-sm');
        $action_onEditDetailEndereco->setLabel("Editar");
        $action_onEditDetailEndereco->setImage('far:edit #478fca');
        $action_onEditDetailEndereco->setFields(['__row__id', '__row__data']);

        $this->endereco_pessoa_list->addAction($action_onEditDetailEndereco);
        $action_onDeleteDetailEndereco = new TDataGridAction(array('PessoaFormEmpresa', 'onDeleteDetailEndereco'));
        $action_onDeleteDetailEndereco->setUseButton(false);
        $action_onDeleteDetailEndereco->setButtonClass('btn btn-default btn-sm');
        $action_onDeleteDetailEndereco->setLabel("Excluir");
        $action_onDeleteDetailEndereco->setImage('fas:trash-alt #dd5a43');
        $action_onDeleteDetailEndereco->setFields(['__row__id', '__row__data']);

        $this->endereco_pessoa_list->addAction($action_onDeleteDetailEndereco);

        $this->endereco_pessoa_list->addColumn($column_endereco_pessoa_tipo_endereco_descricao);
        $this->endereco_pessoa_list->addColumn($column_endereco_pessoa_endereco);
        $this->endereco_pessoa_list->addColumn($column_endereco_pessoa_numero);
        $this->endereco_pessoa_list->addColumn($column_endereco_pessoa_bairro);
        $this->endereco_pessoa_list->addColumn($column_endereco_pessoa_complemento);
        $this->endereco_pessoa_list->addColumn($column_endereco_pessoa_cidade_nome);
        $this->endereco_pessoa_list->addColumn($column_endereco_pessoa_cep);

        $this->endereco_pessoa_list->addColumn($column_endereco_pessoa__row__data);

        $this->endereco_pessoa_list->createModel();
        $tableResponsiveDiv = new TElement('div');
        $tableResponsiveDiv->class = 'table-responsive';
        $tableResponsiveDiv->add($this->endereco_pessoa_list);
        $this->detailFormEnderecoPessoa->addContent([$tableResponsiveDiv]);
        $row11 = $cadastro_pessoa->addFields([$this->detailFormEnderecoPessoa]);
        $row11->layout = [' col-sm-12'];

        $cadastro_pessoa->appendPage("Dados Receita");

        $this->detailFormRamoAtividadePessoa = new BootstrapFormBuilder('detailFormRamoAtividadePessoa');
        $this->detailFormRamoAtividadePessoa->setProperty('style', 'border:none; box-shadow:none; width:100%;');

        $this->detailFormRamoAtividadePessoa->setProperty('class', 'form-horizontal builder-detail-form');

        $row12 = $this->detailFormRamoAtividadePessoa->addFields([new TLabel("Nome :", null, '14px', null, '100%'),$ramo_atividade_pessoa_nome,$ramo_atividade_pessoa_id],[new TLabel("Nome Fantasia:", null, '14px', null, '100%'),$ramo_atividade_pessoa_nome_fantasia]);
        $row12->layout = ['col-sm-6','col-sm-6'];

        $row13 = $this->detailFormRamoAtividadePessoa->addFields([new TLabel("Unidade :", null, '14px', null, '100%'),$ramo_atividade_pessoa_unidade],[new TLabel("Regime Tributário :", null, '14px', null, '100%'),$ramo_atividade_pessoa_regime_tributario],[new TLabel("Data Início Atividade :", null, '14px', null, '100%'),$ramo_atividade_pessoa_dt_inicio_atividade],[new TLabel("Situação Cadastral :", null, '14px', null, '100%'),$ramo_atividade_pessoa_situacao_cadastral]);
        $row13->layout = [' col-sm-3',' col-sm-3',' col-sm-3',' col-sm-3'];

        $row14 = $this->detailFormRamoAtividadePessoa->addFields([new TLabel("Atividade Principal:", null, '14px', null, '100%'),$ramo_atividade_pessoa_atividade_principal]);
        $row14->layout = [' col-sm-12'];

        $row15 = $this->detailFormRamoAtividadePessoa->addFields([new TLabel("Atividade Secundária :", null, '14px', null, '100%'),$ramo_atividade_pessoa_atividade_secundaria]);
        $row15->layout = [' col-sm-12'];

        $row16 = $this->detailFormRamoAtividadePessoa->addFields([new TLabel("Inscrição Estadual:", null, '14px', null, '100%'),$ramo_atividade_pessoa_inscricao_estadual],[new TLabel("Inscrição estadual Ativa :", null, '14px', null, '100%'),$ramo_atividade_pessoa_inscricao_ativa]);
        $row16->layout = ['col-sm-6',' col-sm-6'];

        $row17 = $this->detailFormRamoAtividadePessoa->addFields([$button_adicionar_ramo_atividade_pessoa]);
        $row17->layout = [' col-sm-12'];

        $row18 = $this->detailFormRamoAtividadePessoa->addFields([new THidden('ramo_atividade_pessoa__row__id')]);
        $this->ramo_atividade_pessoa_criteria = new TCriteria();

        $this->ramo_atividade_pessoa_list = new BootstrapDatagridWrapper(new TDataGrid);
        $this->ramo_atividade_pessoa_list->disableHtmlConversion();;
        $this->ramo_atividade_pessoa_list->generateHiddenFields();
        $this->ramo_atividade_pessoa_list->setId('ramo_atividade_pessoa_list');

        $this->ramo_atividade_pessoa_list->style = 'width:100%';
        $this->ramo_atividade_pessoa_list->class .= ' table-bordered';

        $column_ramo_atividade_pessoa_nome = new TDataGridColumn('nome', "Nome", 'left');
        $column_ramo_atividade_pessoa_unidade = new TDataGridColumn('unidade', "Unidade", 'left');
        $column_ramo_atividade_pessoa_situacao_cadastral = new TDataGridColumn('situacao_cadastral', "Situação Cadastral", 'left');
        $column_ramo_atividade_pessoa_inscricao_estadual = new TDataGridColumn('inscricao_estadual', "Inscrição Estadual", 'left');
        $column_ramo_atividade_pessoa_regime_tributario = new TDataGridColumn('regime_tributario', "Regime Tributário", 'left');

        $column_ramo_atividade_pessoa__row__data = new TDataGridColumn('__row__data', '', 'center');
        $column_ramo_atividade_pessoa__row__data->setVisibility(false);

        $action_onEditDetailRamoAtividade = new TDataGridAction(array('PessoaFormEmpresa', 'onEditDetailRamoAtividade'));
        $action_onEditDetailRamoAtividade->setUseButton(false);
        $action_onEditDetailRamoAtividade->setButtonClass('btn btn-default btn-sm');
        $action_onEditDetailRamoAtividade->setLabel("Editar");
        $action_onEditDetailRamoAtividade->setImage('far:edit #478fca');
        $action_onEditDetailRamoAtividade->setFields(['__row__id', '__row__data']);

        $this->ramo_atividade_pessoa_list->addAction($action_onEditDetailRamoAtividade);
        $action_onDeleteDetailRamoAtividade = new TDataGridAction(array('PessoaFormEmpresa', 'onDeleteDetailRamoAtividade'));
        $action_onDeleteDetailRamoAtividade->setUseButton(false);
        $action_onDeleteDetailRamoAtividade->setButtonClass('btn btn-default btn-sm');
        $action_onDeleteDetailRamoAtividade->setLabel("Excluir");
        $action_onDeleteDetailRamoAtividade->setImage('fas:trash-alt #dd5a43');
        $action_onDeleteDetailRamoAtividade->setFields(['__row__id', '__row__data']);

        $this->ramo_atividade_pessoa_list->addAction($action_onDeleteDetailRamoAtividade);

        $this->ramo_atividade_pessoa_list->addColumn($column_ramo_atividade_pessoa_nome);
        $this->ramo_atividade_pessoa_list->addColumn($column_ramo_atividade_pessoa_unidade);
        $this->ramo_atividade_pessoa_list->addColumn($column_ramo_atividade_pessoa_situacao_cadastral);
        $this->ramo_atividade_pessoa_list->addColumn($column_ramo_atividade_pessoa_inscricao_estadual);
        $this->ramo_atividade_pessoa_list->addColumn($column_ramo_atividade_pessoa_regime_tributario);

        $this->ramo_atividade_pessoa_list->addColumn($column_ramo_atividade_pessoa__row__data);

        $this->ramo_atividade_pessoa_list->createModel();
        $tableResponsiveDiv = new TElement('div');
        $tableResponsiveDiv->class = 'table-responsive';
        $tableResponsiveDiv->add($this->ramo_atividade_pessoa_list);
        $this->detailFormRamoAtividadePessoa->addContent([$tableResponsiveDiv]);
        $row19 = $cadastro_pessoa->addFields([$button_buscar_dados_da_receita,$this->detailFormRamoAtividadePessoa]);
        $row19->layout = [' col-sm-12'];

        $row20 = $this->form->addFields([$cadastro_pessoa]);
        $row20->layout = [' col-sm-12'];

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave'],['static' => 1]), 'fas:save #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');
        $this->btn_onclear = $btn_onclear;

        $btn_onshow = $this->form->addAction("Voltar", new TAction(['PessoaListEmpresa', 'onShow']), 'fas:arrow-left #000000');
        $this->btn_onshow = $btn_onshow;

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        if(empty($param['target_container']))
        {
            $container->add(TBreadCrumb::create(["Pessoas","Cadastro de Empresa"]));
        }
        $container->add($this->form);

        parent::add($container);

    }

    public static function onChangeCEP($param = null) 
    {
        try 
        {
            //code here
            $object = new stdClass;

            // so busca dados do cep houve alteracao do cep anterior
            //if ($param['endereco_pessoa_cep'] != $param['endereco_cep_conf'])
            if ($param['endereco_pessoa_cep'])
            {
                $result = (! empty($param['endereco_pessoa_cep'])) ? BuilderCEPService::get($param['endereco_pessoa_cep']) : NULL;

                if($result)
                {
                    $object->estado_id = $result->estado;
                    $object->endereco_pessoa_cidade_id = $result->cidade;
                    $object->endereco_pessoa_bairro    = isset($result->bairro) ? trim($result->bairro) : '';
                    $object->endereco_pessoa_endereco  = isset($result->logradouro) ? trim($result->logradouro) : '';
                }
                else
                {
                    $object->endereco_pessoa_cidade_id   = '';
                    $object->endereco_pessoa_bairro       = '';
                    $object->endereco_pessoa_endereco    = '';
                    $object->endereco_pessoa_numero      = '';
                    $object->endereco_pessoa_complemento = '';
                }
            }

            //$object->endereco_cep_conf = $param['endereco_cep'];

            TForm::sendData(self::$formName, $object, FALSE, true);

        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

    public  function onAddDetailEnderecoPessoa($param = null) 
    {
        try
        {
            $data = $this->form->getData();

            $errors = [];
            $requiredFields = [];
            $requiredFields[] = ['label'=>"Cidade id", 'name'=>"endereco_pessoa_cidade_id", 'class'=>'TRequiredValidator', 'value'=>[]];
            $requiredFields[] = ['label'=>"Tipo endereco id", 'name'=>"endereco_pessoa_tipo_endereco_id", 'class'=>'TRequiredValidator', 'value'=>[]];
            foreach($requiredFields as $requiredField)
            {
                try
                {
                    (new $requiredField['class'])->validate($requiredField['label'], $data->{$requiredField['name']}, $requiredField['value']);
                }
                catch(Exception $e)
                {
                    $errors[] = $e->getMessage() . '.';
                }
             }
             if(count($errors) > 0)
             {
                 throw new Exception(implode('<br>', $errors));
             }

            $__row__id = !empty($data->endereco_pessoa__row__id) ? $data->endereco_pessoa__row__id : 'b'.uniqid();

            TTransaction::open(self::$database);

            $grid_data = new Endereco();
            $grid_data->__row__id = $__row__id;
            $grid_data->cep = $data->endereco_pessoa_cep;
            $grid_data->endereco = $data->endereco_pessoa_endereco;
            $grid_data->id = $data->endereco_pessoa_id;
            $grid_data->numero = $data->endereco_pessoa_numero;
            $grid_data->bairro = $data->endereco_pessoa_bairro;
            $grid_data->complemento = $data->endereco_pessoa_complemento;
            $grid_data->cidade_id = $data->endereco_pessoa_cidade_id;
            $grid_data->estado_id = $data->estado_id;
            $grid_data->tipo_endereco_id = $data->endereco_pessoa_tipo_endereco_id;

            $__row__data = array_merge($grid_data->toArray(), (array)$grid_data->getVirtualData());
            $__row__data['__row__id'] = $__row__id;
            $__row__data['__display__']['cep'] =  $param['endereco_pessoa_cep'] ?? null;
            $__row__data['__display__']['endereco'] =  $param['endereco_pessoa_endereco'] ?? null;
            $__row__data['__display__']['id'] =  $param['endereco_pessoa_id'] ?? null;
            $__row__data['__display__']['numero'] =  $param['endereco_pessoa_numero'] ?? null;
            $__row__data['__display__']['bairro'] =  $param['endereco_pessoa_bairro'] ?? null;
            $__row__data['__display__']['complemento'] =  $param['endereco_pessoa_complemento'] ?? null;
            $__row__data['__display__']['cidade_id'] =  $param['endereco_pessoa_cidade_id'] ?? null;
            $__row__data['__display__']['estado_id'] =  $param['estado_id'] ?? null;
            $__row__data['__display__']['tipo_endereco_id'] =  $param['endereco_pessoa_tipo_endereco_id'] ?? null;

            $grid_data->__row__data = base64_encode(serialize((object)$__row__data));
            $row = $this->endereco_pessoa_list->addItem($grid_data);
            $row->id = $grid_data->__row__id;

            TDataGrid::replaceRowById('endereco_pessoa_list', $grid_data->__row__id, $row);

            TTransaction::close();

            $data = new stdClass;
            $data->endereco_pessoa_cep = '';
            $data->endereco_pessoa_endereco = '';
            $data->endereco_pessoa_id = '';
            $data->endereco_pessoa_numero = '';
            $data->endereco_pessoa_bairro = '';
            $data->endereco_pessoa_complemento = '';
            $data->endereco_pessoa_cidade_id = '';
            $data->estado_id = '';
            $data->endereco_pessoa_tipo_endereco_id = '';
            $data->endereco_pessoa__row__id = '';

            TForm::sendData(self::$formName, $data);
            TScript::create("
               var element = $('#6543bb62aba83');
               if(typeof element.attr('add') != 'undefined')
               {
                   element.html(base64_decode(element.attr('add')));
               }
            ");

        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
        }
    }

    public  function onAddDetailRamoAtividadePessoa($param = null) 
    {
        try
        {
            $data = $this->form->getData();

            $__row__id = !empty($data->ramo_atividade_pessoa__row__id) ? $data->ramo_atividade_pessoa__row__id : 'b'.uniqid();

            TTransaction::open(self::$database);

            $grid_data = new RamoAtividade();
            $grid_data->__row__id = $__row__id;
            $grid_data->nome = $data->ramo_atividade_pessoa_nome;
            $grid_data->id = $data->ramo_atividade_pessoa_id;
            $grid_data->nome_fantasia = $data->ramo_atividade_pessoa_nome_fantasia;
            $grid_data->unidade = $data->ramo_atividade_pessoa_unidade;
            $grid_data->regime_tributario = $data->ramo_atividade_pessoa_regime_tributario;
            $grid_data->dt_inicio_atividade = $data->ramo_atividade_pessoa_dt_inicio_atividade;
            $grid_data->situacao_cadastral = $data->ramo_atividade_pessoa_situacao_cadastral;
            $grid_data->atividade_principal = $data->ramo_atividade_pessoa_atividade_principal;
            $grid_data->atividade_secundaria = $data->ramo_atividade_pessoa_atividade_secundaria;
            $grid_data->inscricao_estadual = $data->ramo_atividade_pessoa_inscricao_estadual;
            $grid_data->inscricao_ativa = $data->ramo_atividade_pessoa_inscricao_ativa;

            $__row__data = array_merge($grid_data->toArray(), (array)$grid_data->getVirtualData());
            $__row__data['__row__id'] = $__row__id;
            $__row__data['__display__']['nome'] =  $param['ramo_atividade_pessoa_nome'] ?? null;
            $__row__data['__display__']['id'] =  $param['ramo_atividade_pessoa_id'] ?? null;
            $__row__data['__display__']['nome_fantasia'] =  $param['ramo_atividade_pessoa_nome_fantasia'] ?? null;
            $__row__data['__display__']['unidade'] =  $param['ramo_atividade_pessoa_unidade'] ?? null;
            $__row__data['__display__']['regime_tributario'] =  $param['ramo_atividade_pessoa_regime_tributario'] ?? null;
            $__row__data['__display__']['dt_inicio_atividade'] =  $param['ramo_atividade_pessoa_dt_inicio_atividade'] ?? null;
            $__row__data['__display__']['situacao_cadastral'] =  $param['ramo_atividade_pessoa_situacao_cadastral'] ?? null;
            $__row__data['__display__']['atividade_principal'] =  $param['ramo_atividade_pessoa_atividade_principal'] ?? null;
            $__row__data['__display__']['atividade_secundaria'] =  $param['ramo_atividade_pessoa_atividade_secundaria'] ?? null;
            $__row__data['__display__']['inscricao_estadual'] =  $param['ramo_atividade_pessoa_inscricao_estadual'] ?? null;
            $__row__data['__display__']['inscricao_ativa'] =  $param['ramo_atividade_pessoa_inscricao_ativa'] ?? null;

            $grid_data->__row__data = base64_encode(serialize((object)$__row__data));
            $row = $this->ramo_atividade_pessoa_list->addItem($grid_data);
            $row->id = $grid_data->__row__id;

            TDataGrid::replaceRowById('ramo_atividade_pessoa_list', $grid_data->__row__id, $row);

            TTransaction::close();

            $data = new stdClass;
            $data->ramo_atividade_pessoa_nome = '';
            $data->ramo_atividade_pessoa_id = '';
            $data->ramo_atividade_pessoa_nome_fantasia = '';
            $data->ramo_atividade_pessoa_unidade = '';
            $data->ramo_atividade_pessoa_regime_tributario = '';
            $data->ramo_atividade_pessoa_dt_inicio_atividade = '';
            $data->ramo_atividade_pessoa_situacao_cadastral = '';
            $data->ramo_atividade_pessoa_atividade_principal = '';
            $data->ramo_atividade_pessoa_atividade_secundaria = '';
            $data->ramo_atividade_pessoa_inscricao_estadual = '';
            $data->ramo_atividade_pessoa_inscricao_ativa = '';
            $data->ramo_atividade_pessoa__row__id = '';

            TForm::sendData(self::$formName, $data);
            TScript::create("
               var element = $('#654d91050be56');
               if(typeof element.attr('add') != 'undefined')
               {
                   element.html(base64_decode(element.attr('add')));
               }
            ");

        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
        }
    }

    public static function onEditDetailEndereco($param = null) 
    {
        try
        {

            $__row__data = unserialize(base64_decode($param['__row__data']));
            $__row__data->__display__ = is_array($__row__data->__display__) ? (object) $__row__data->__display__ : $__row__data->__display__;

            $data = new stdClass;
            $data->endereco_pessoa_cep = $__row__data->__display__->cep ?? null;
            $data->endereco_pessoa_endereco = $__row__data->__display__->endereco ?? null;
            $data->endereco_pessoa_id = $__row__data->__display__->id ?? null;
            $data->endereco_pessoa_numero = $__row__data->__display__->numero ?? null;
            $data->endereco_pessoa_bairro = $__row__data->__display__->bairro ?? null;
            $data->endereco_pessoa_complemento = $__row__data->__display__->complemento ?? null;
            $data->endereco_pessoa_cidade_id = $__row__data->__display__->cidade_id ?? null;
            $data->estado_id = $__row__data->__display__->estado_id ?? null;
            $data->endereco_pessoa_tipo_endereco_id = $__row__data->__display__->tipo_endereco_id ?? null;
            $data->endereco_pessoa__row__id = $__row__data->__row__id;

            TForm::sendData(self::$formName, $data);
            TScript::create("
               var element = $('#6543bb62aba83');
               if(!element.attr('add')){
                   element.attr('add', base64_encode(element.html()));
               }
               element.html(\"<span><i class='far fa-edit' style='color:#478fca;padding-right:4px;'></i>Editar</span>\");
               if(!element.attr('edit')){
                   element.attr('edit', base64_encode(element.html()));
               }
            ");

        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
        }
    }
    public static function onDeleteDetailEndereco($param = null) 
    {
        try
        {

            $__row__data = unserialize(base64_decode($param['__row__data']));

            $data = new stdClass;
            $data->endereco_pessoa_cep = '';
            $data->endereco_pessoa_endereco = '';
            $data->endereco_pessoa_id = '';
            $data->endereco_pessoa_numero = '';
            $data->endereco_pessoa_bairro = '';
            $data->endereco_pessoa_complemento = '';
            $data->endereco_pessoa_cidade_id = '';
            $data->estado_id = '';
            $data->endereco_pessoa_tipo_endereco_id = '';
            $data->endereco_pessoa__row__id = '';

            TForm::sendData(self::$formName, $data);

            TDataGrid::removeRowById('endereco_pessoa_list', $__row__data->__row__id);

        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
        }
    }
    public static function onEditDetailRamoAtividade($param = null) 
    {
        try
        {

            $__row__data = unserialize(base64_decode($param['__row__data']));
            $__row__data->__display__ = is_array($__row__data->__display__) ? (object) $__row__data->__display__ : $__row__data->__display__;

            $data = new stdClass;
            $data->ramo_atividade_pessoa_nome = $__row__data->__display__->nome ?? null;
            $data->ramo_atividade_pessoa_id = $__row__data->__display__->id ?? null;
            $data->ramo_atividade_pessoa_nome_fantasia = $__row__data->__display__->nome_fantasia ?? null;
            $data->ramo_atividade_pessoa_unidade = $__row__data->__display__->unidade ?? null;
            $data->ramo_atividade_pessoa_regime_tributario = $__row__data->__display__->regime_tributario ?? null;
            $data->ramo_atividade_pessoa_dt_inicio_atividade = $__row__data->__display__->dt_inicio_atividade ?? null;
            $data->ramo_atividade_pessoa_situacao_cadastral = $__row__data->__display__->situacao_cadastral ?? null;
            $data->ramo_atividade_pessoa_atividade_principal = $__row__data->__display__->atividade_principal ?? null;
            $data->ramo_atividade_pessoa_atividade_secundaria = $__row__data->__display__->atividade_secundaria ?? null;
            $data->ramo_atividade_pessoa_inscricao_estadual = $__row__data->__display__->inscricao_estadual ?? null;
            $data->ramo_atividade_pessoa_inscricao_ativa = $__row__data->__display__->inscricao_ativa ?? null;
            $data->ramo_atividade_pessoa__row__id = $__row__data->__row__id;

            TForm::sendData(self::$formName, $data);
            TScript::create("
               var element = $('#654d91050be56');
               if(!element.attr('add')){
                   element.attr('add', base64_encode(element.html()));
               }
               element.html(\"<span><i class='far fa-edit' style='color:#478fca;padding-right:4px;'></i>Editar</span>\");
               if(!element.attr('edit')){
                   element.attr('edit', base64_encode(element.html()));
               }
            ");

        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
        }
    }
    public static function onDeleteDetailRamoAtividade($param = null) 
    {
        try
        {

            $__row__data = unserialize(base64_decode($param['__row__data']));

            $data = new stdClass;
            $data->ramo_atividade_pessoa_nome = '';
            $data->ramo_atividade_pessoa_id = '';
            $data->ramo_atividade_pessoa_nome_fantasia = '';
            $data->ramo_atividade_pessoa_unidade = '';
            $data->ramo_atividade_pessoa_regime_tributario = '';
            $data->ramo_atividade_pessoa_dt_inicio_atividade = '';
            $data->ramo_atividade_pessoa_situacao_cadastral = '';
            $data->ramo_atividade_pessoa_atividade_principal = '';
            $data->ramo_atividade_pessoa_atividade_secundaria = '';
            $data->ramo_atividade_pessoa_inscricao_estadual = '';
            $data->ramo_atividade_pessoa_inscricao_ativa = '';
            $data->ramo_atividade_pessoa__row__id = '';

            TForm::sendData(self::$formName, $data);

            TDataGrid::removeRowById('ramo_atividade_pessoa_list', $__row__data->__row__id);

        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
        }
    }
    public function onSave($param = null) 
    {
        try
        {
            TTransaction::open(self::$database); // open a transaction

            $messageAction = null;

            $this->form->validate(); // validate form data

            $object = new Pessoa(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            $object->store(); // save the object 

            TForm::sendData(self::$formName, (object)['id' => $object->id]);

            $loadPageParam = [];

            if(!empty($param['target_container']))
            {
                $loadPageParam['target_container'] = $param['target_container'];
            }

            $ramo_atividade_pessoa_items = $this->storeMasterDetailItems('RamoAtividade', 'pessoa_id', 'ramo_atividade_pessoa', $object, $param['ramo_atividade_pessoa_list___row__data'] ?? [], $this->form, $this->ramo_atividade_pessoa_list, function($masterObject, $detailObject){ 

                //code here

            }, $this->ramo_atividade_pessoa_criteria); 

            $endereco_pessoa_items = $this->storeMasterDetailItems('Endereco', 'pessoa_id', 'endereco_pessoa', $object, $param['endereco_pessoa_list___row__data'] ?? [], $this->form, $this->endereco_pessoa_list, function($masterObject, $detailObject){ 

                //code here

            }, $this->endereco_pessoa_criteria); 

            // get the generated {PRIMARY_KEY}
            $data->id = $object->id; 

            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            TToast::show('success', "Registro salvo", 'topRight', 'far:check-circle');
            TApplication::loadPage('PessoaListEmpresa', 'onShow', $loadPageParam); 

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

                $object = new Pessoa($key); // instantiates the Active Record 

                $ramo_atividade_pessoa_items = $this->loadMasterDetailItems('RamoAtividade', 'pessoa_id', 'ramo_atividade_pessoa', $object, $this->form, $this->ramo_atividade_pessoa_list, $this->ramo_atividade_pessoa_criteria, function($masterObject, $detailObject, $objectItems){ 

                    //code here

                }); 

                $endereco_pessoa_items = $this->loadMasterDetailItems('Endereco', 'pessoa_id', 'endereco_pessoa', $object, $this->form, $this->endereco_pessoa_list, $this->endereco_pessoa_criteria, function($masterObject, $detailObject, $objectItems){ 

                    //code here

                }); 

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

    public static function onBuscaDadosReceita($param = null) 
    {
        try 
        {
            //code here
            $dados = BuilderCNPJService::getFull($param['documento']);

            $socios = $dados->socios;
            $atividade_secundaria = $dados->estabelecimento->atividades_secundarias;
            $atividade_princial = $dados->estabelecimento->atividade_principal;
            $nome_fantasia = $dados->estabelecimento->nome_fantasia;
            $unidade = $dados->estabelecimento->tipo;
            $regime_tributario = $dados->estabelecimento->regimes_tributarios;
            $dt_inicio_atividade = $dados->estabelecimento->data_inicio_atividade;
            $situacao_cadastral = $dados->estabelecimento->situacao_cadastral;
            $inscricao_estadual = $dados->estabelecimento->inscricoes_estaduais;

            $dados_atv_principal = $atividade_princial->subclasse . ' - ' . $atividade_princial->descricao;

            $atv_secundaria = [];

            foreach($atividade_secundaria as $atividades_secundarias)
            {
                $atv_secundaria[] = $atividades_secundarias->descricao;
            }

            foreach($regime_tributario as $regimes_tributarios)
            {
                $tipo_regime_tributario = $regimes_tributarios->regime_tributario;
            }

            foreach($inscricao_estadual as $ie)
            {
                $numero_inscricao = $ie->inscricao_estadual;
                $inscricao_ativa = $ie->ativo;
            }

            $dados_form = new stdClass();
            $dados_form->ramo_atividade_pessoa_nome = $dados->razao_social;
            $dados_form->ramo_atividade_pessoa_nome_fantasia = $nome_fantasia;
            $dados_form->ramo_atividade_pessoa_unidade = $unidade;
            $dados_form->ramo_atividade_pessoa_regime_tributario = $tipo_regime_tributario;
            $dados_form->ramo_atividade_pessoa_dt_inicio_atividade = $dt_inicio_atividade;
            $dados_form->ramo_atividade_pessoa_atividade_principal = $dados_atv_principal;
            $dados_form->ramo_atividade_pessoa_situacao_cadastral = $situacao_cadastral;
            $dados_form->ramo_atividade_pessoa_atividade_secundaria =  implode(' - ', $atv_secundaria);
            $dados_form->ramo_atividade_pessoa_inscricao_estadual = $numero_inscricao;
            $dados_form->ramo_atividade_pessoa_inscricao_ativa = $inscricao_ativa;

            TForm::sendData(self::$formName, $dados_form);
        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

}

