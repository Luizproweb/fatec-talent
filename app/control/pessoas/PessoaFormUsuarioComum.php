<?php

class PessoaFormUsuarioComum extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'u316696823_fatec_talent';
    private static $activeRecord = 'Pessoa';
    private static $primaryKey = 'id';
    private static $formName = 'form_PessoaForm';

    use BuilderMasterDetailTrait;
    use Adianti\Base\AdiantiFileSaveTrait;

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
        $documento = new TEntry('documento');
        $fone = new TEntry('fone');
        $celular = new TEntry('celular');
        $site = new TEntry('site');
        $email = new TEntry('email');
        $anexo_curriculo = new TFile('anexo_curriculo');
        $observacao = new TText('observacao');
        $endereco_pessoa_cep = new TEntry('endereco_pessoa_cep');
        $endereco_pessoa_endereco = new TEntry('endereco_pessoa_endereco');
        $endereco_pessoa_id = new THidden('endereco_pessoa_id');
        $endereco_pessoa_numero = new TEntry('endereco_pessoa_numero');
        $endereco_pessoa_bairro = new TEntry('endereco_pessoa_bairro');
        $endereco_pessoa_complemento = new TEntry('endereco_pessoa_complemento');
        $endereco_pessoa_cidade_id = new TDBCombo('endereco_pessoa_cidade_id', 'u316696823_fatec_talent', 'Cidade', 'id', '{nome}','id asc'  );
        $endereco_pessoa_tipo_endereco_id = new TDBCombo('endereco_pessoa_tipo_endereco_id', 'u316696823_fatec_talent', 'TipoEndereco', 'id', '{descricao}','id asc'  );
        $button_adicionar_endereco_pessoa = new TButton('button_adicionar_endereco_pessoa');
        $area_atuacao_id = new TDBMultiSearch('area_atuacao_id', 'u316696823_fatec_talent', 'AreaAtuacao', 'id', 'descricao','id asc'  );
        $habilidade_id = new TDBMultiSearch('habilidade_id', 'u316696823_fatec_talent', 'Habilidade', 'id', 'descricao','id asc'  );

        $endereco_pessoa_cep->setExitAction(new TAction([$this,'onChangeCEP']));

        $system_user->addValidation("System user", new TRequiredValidator()); 
        $documento->addValidation("Documento ", new TRequiredValidator()); 
        $email->addValidation("E-mail", new TEmailValidator(), []); 

        $anexo_curriculo->enableFileHandling();
        $anexo_curriculo->setLimitUploadSize(10);
        $anexo_curriculo->setAllowedExtensions(["pdf"]);
        $endereco_pessoa_numero->setMaxLength(10);
        $button_adicionar_endereco_pessoa->setAction(new TAction([$this, 'onAddDetailEnderecoPessoa'],['static' => 1]), "Adicionar");
        $button_adicionar_endereco_pessoa->addStyleClass('btn-default');
        $button_adicionar_endereco_pessoa->setImage('fas:plus #2ecc71');
        $habilidade_id->setMinLength(0);
        $area_atuacao_id->setMinLength(0);

        $habilidade_id->setFilterColumns(["codigo","descricao"]);
        $area_atuacao_id->setFilterColumns(["codigo","descricao"]);

        $id->setEditable(false);
        $documento->setEditable(false);
        $system_user->setEditable(false);

        $system_user->enableSearch();
        $endereco_pessoa_cidade_id->enableSearch();
        $endereco_pessoa_tipo_endereco_id->enableSearch();

        $fone->setMask('(99)9999-9999');
        $celular->setMask('(99)99999-9999');
        $habilidade_id->setMask('{descricao}');
        $area_atuacao_id->setMask('{descricao}');

        $id->setSize(100);
        $fone->setSize('100%');
        $site->setSize('100%');
        $email->setSize('100%');
        $celular->setSize('100%');
        $documento->setSize('100%');
        $system_user->setSize('100%');
        $observacao->setSize('100%', 70);
        $anexo_curriculo->setSize('100%');
        $endereco_pessoa_id->setSize(200);
        $habilidade_id->setSize('100%', 70);
        $endereco_pessoa_cep->setSize('100%');
        $area_atuacao_id->setSize('100%', 70);
        $endereco_pessoa_numero->setSize('100%');
        $endereco_pessoa_bairro->setSize('100%');
        $endereco_pessoa_endereco->setSize('100%');
        $endereco_pessoa_cidade_id->setSize('100%');
        $endereco_pessoa_complemento->setSize('100%');
        $endereco_pessoa_tipo_endereco_id->setSize('100%');

        $button_adicionar_endereco_pessoa->id = '6543bb62aba83';

        $cadastro_pessoa = new BootstrapFormBuilder('cadastro_pessoa');
        $this->cadastro_pessoa = $cadastro_pessoa;
        $cadastro_pessoa->setProperty('style', 'border:none; box-shadow:none;');

        $cadastro_pessoa->appendPage("Dados Gerais");

        $cadastro_pessoa->addFields([new THidden('current_tab_cadastro_pessoa')]);
        $cadastro_pessoa->setTabFunction("$('[name=current_tab_cadastro_pessoa]').val($(this).attr('data-current_page'));");

        $row1 = $cadastro_pessoa->addFields([new TLabel("Id:", null, '14px', null, '100%'),$id],[new TLabel("Usuário do Sistema:", '#000000', '14px', null, '100%'),$system_user],[new TLabel("CPF/CNPJ:", '#000000', '14px', null, '100%'),$documento]);
        $row1->layout = ['col-sm-2','col-sm-5',' col-sm-5'];

        $row2 = $cadastro_pessoa->addFields([new TLabel("Telefone :", null, '14px', null, '100%'),$fone],[new TLabel("Celular :", null, '14px', null, '100%'),$celular],[new TLabel("Site :", null, '14px', null, '100%'),$site]);
        $row2->layout = ['col-sm-4','col-sm-4',' col-sm-4'];

        $row3 = $cadastro_pessoa->addFields([new TLabel("E-mail:", null, '14px', null, '100%'),$email],[new TLabel("Currículo:", null, '14px', null),$anexo_curriculo]);
        $row3->layout = [' col-sm-6','col-sm-6'];

        $row4 = $cadastro_pessoa->addFields([new TLabel("Observações Gerais do Usuário:", null, '14px', null, '100%'),$observacao]);
        $row4->layout = [' col-sm-12'];

        $cadastro_pessoa->appendPage("Endereço");

        $this->detailFormEnderecoPessoa = new BootstrapFormBuilder('detailFormEnderecoPessoa');
        $this->detailFormEnderecoPessoa->setProperty('style', 'border:none; box-shadow:none; width:100%;');

        $this->detailFormEnderecoPessoa->setProperty('class', 'form-horizontal builder-detail-form');

        $row5 = $this->detailFormEnderecoPessoa->addFields([new TLabel("CEP :", null, '14px', null, '100%'),$endereco_pessoa_cep]);
        $row5->layout = [' col-sm-3'];

        $row6 = $this->detailFormEnderecoPessoa->addFields([new TLabel("Endereço :", null, '14px', null, '100%'),$endereco_pessoa_endereco,$endereco_pessoa_id],[new TLabel("Número :", null, '14px', null, '100%'),$endereco_pessoa_numero],[new TLabel("Bairro :", null, '14px', null, '100%'),$endereco_pessoa_bairro]);
        $row6->layout = [' col-sm-6',' col-sm-2',' col-sm-4'];

        $row7 = $this->detailFormEnderecoPessoa->addFields([new TLabel("Complemento :", null, '14px', null, '100%'),$endereco_pessoa_complemento],[new TLabel("Cidade", '#ff0000', '14px', null, '100%'),$endereco_pessoa_cidade_id]);
        $row7->layout = ['col-sm-6',' col-sm-6'];

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
        $column_endereco_pessoa_cidade_nome = new TDataGridColumn('{cidade->nome}', "Cidade", 'left');
        $column_endereco_pessoa_cep = new TDataGridColumn('cep', "CEP", 'left');

        $column_endereco_pessoa__row__data = new TDataGridColumn('__row__data', '', 'center');
        $column_endereco_pessoa__row__data->setVisibility(false);

        $action_onEditDetailEndereco = new TDataGridAction(array('PessoaFormUsuarioComum', 'onEditDetailEndereco'));
        $action_onEditDetailEndereco->setUseButton(false);
        $action_onEditDetailEndereco->setButtonClass('btn btn-default btn-sm');
        $action_onEditDetailEndereco->setLabel("Editar");
        $action_onEditDetailEndereco->setImage('far:edit #478fca');
        $action_onEditDetailEndereco->setFields(['__row__id', '__row__data']);

        $this->endereco_pessoa_list->addAction($action_onEditDetailEndereco);
        $action_onDeleteDetailEndereco = new TDataGridAction(array('PessoaFormUsuarioComum', 'onDeleteDetailEndereco'));
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

        $cadastro_pessoa->appendPage("Competências");
        $row12 = $cadastro_pessoa->addFields([new TLabel("Áreas de Atuação:", '#F44336', '14px', null, '100%'),$area_atuacao_id]);
        $row12->layout = [' col-sm-12'];

        $row13 = $cadastro_pessoa->addFields([new TLabel("Habilidades:", '#F44336', '14px', null, '100%'),$habilidade_id]);
        $row13->layout = [' col-sm-12'];

        $row14 = $this->form->addFields([$cadastro_pessoa]);
        $row14->layout = [' col-sm-12'];

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave'],['static' => 1]), 'fas:save #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');
        $this->btn_onclear = $btn_onclear;

        $btn_onshow = $this->form->addAction("Voltar", new TAction(['PessoaListUsuarioComum', 'onShow']), 'fas:arrow-left #000000');
        $this->btn_onshow = $btn_onshow;

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        if(empty($param['target_container']))
        {
            $container->add(TBreadCrumb::create(["Pessoas","Dados Cadastrais Usuário"]));
        }
        $container->add($this->form);

        parent::add($container);

    }

    public static function onChangeCEP($param = null) 
    {
        try 
        {
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

            $anexo_curriculo_dir = 'files/pessoa/anexo';  

            $object->store(); // save the object 

            $repository = PessoaAreaAtuacao::where('pessoa_id', '=', $object->id);
            $repository->delete(); 

            if ($data->area_atuacao_id) 
            {
                foreach ($data->area_atuacao_id as $area_atuacao_id_value) 
                {
                    $pessoa_area_atuacao = new PessoaAreaAtuacao;

                    $pessoa_area_atuacao->area_atuacao_id = $area_atuacao_id_value;
                    $pessoa_area_atuacao->pessoa_id = $object->id;
                    $pessoa_area_atuacao->store();
                }
            }

            $repository = PreferenciaHabilidade::where('pessoa_id', '=', $object->id);
            $repository->delete(); 

            if ($data->habilidade_id) 
            {
                foreach ($data->habilidade_id as $habilidade_id_value) 
                {
                    $preferencia_habilidade = new PreferenciaHabilidade;

                    $preferencia_habilidade->habilidade_id = $habilidade_id_value;
                    $preferencia_habilidade->pessoa_id = $object->id;
                    $preferencia_habilidade->store();
                }
            }

            $this->saveFile($object, $data, 'anexo_curriculo', $anexo_curriculo_dir);
            TForm::sendData(self::$formName, (object)['id' => $object->id]);

            $endereco_pessoa_items = $this->storeMasterDetailItems('Endereco', 'pessoa_id', 'endereco_pessoa', $object, $param['endereco_pessoa_list___row__data'] ?? [], $this->form, $this->endereco_pessoa_list, function($masterObject, $detailObject){ 

                //code here

            }, $this->endereco_pessoa_criteria); 

            // get the generated {PRIMARY_KEY}
            $data->id = $object->id; 

            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            TToast::show('success', "Registro salvo", 'topRight', 'far:check-circle'); 

            TApplication::loadPage('PessoaListUsuarioComum', 'onShow', ['key'=> $object->id]);

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

                $object->area_atuacao_id = PessoaAreaAtuacao::where('pessoa_id', '=', $object->id)->getIndexedArray('area_atuacao_id', 'area_atuacao_id');

                $object->habilidade_id = PreferenciaHabilidade::where('pessoa_id', '=', $object->id)->getIndexedArray('habilidade_id', 'habilidade_id');

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

}

