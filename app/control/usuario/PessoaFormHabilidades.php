<?php

class PessoaFormHabilidades extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'u316696823_fatec_talent';
    private static $activeRecord = 'Pessoa';
    private static $primaryKey = 'id';
    private static $formName = 'form_PessoaForm';

    use BuilderMasterDetailFieldListTrait;

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
        $this->form->setFormTitle("Cadastro de Habilidades");


        $id = new TEntry('id');
        $system_user = new TDBCombo('system_user', 'u316696823_fatec_talent', 'SystemUsers', 'id', '{name}','name asc'  );
        $documento = new TEntry('documento');
        $preferencia_habilidade_pessoa_id = new THidden('preferencia_habilidade_pessoa_id[]');
        $preferencia_habilidade_pessoa___row__id = new THidden('preferencia_habilidade_pessoa___row__id[]');
        $preferencia_habilidade_pessoa___row__data = new THidden('preferencia_habilidade_pessoa___row__data[]');
        $preferencia_habilidade_pessoa_habilidade_id = new TDBCombo('preferencia_habilidade_pessoa_habilidade_id[]', 'u316696823_fatec_talent', 'Habilidade', 'id', ' {codigo} - {descricao}','id asc'  );
        $this->fieldList_pessoa_habilidade = new TFieldList();

        $this->fieldList_pessoa_habilidade->addField(null, $preferencia_habilidade_pessoa_id, []);
        $this->fieldList_pessoa_habilidade->addField(null, $preferencia_habilidade_pessoa___row__id, ['uniqid' => true]);
        $this->fieldList_pessoa_habilidade->addField(null, $preferencia_habilidade_pessoa___row__data, []);
        $this->fieldList_pessoa_habilidade->addField(new TLabel("Habilidade id", null, '14px', null), $preferencia_habilidade_pessoa_habilidade_id, ['width' => '100%']);

        $this->fieldList_pessoa_habilidade->width = '100%';
        $this->fieldList_pessoa_habilidade->setFieldPrefix('preferencia_habilidade_pessoa');
        $this->fieldList_pessoa_habilidade->name = 'fieldList_pessoa_habilidade';

        $this->criteria_fieldList_pessoa_habilidade = new TCriteria();
        $this->default_item_fieldList_pessoa_habilidade = new stdClass();

        $this->form->addField($preferencia_habilidade_pessoa_id);
        $this->form->addField($preferencia_habilidade_pessoa___row__id);
        $this->form->addField($preferencia_habilidade_pessoa___row__data);
        $this->form->addField($preferencia_habilidade_pessoa_habilidade_id);

        $this->fieldList_pessoa_habilidade->setRemoveAction(null, 'fas:times #dd5a43', "Excluír");

        $system_user->addValidation("System user", new TRequiredValidator()); 
        $documento->addValidation("Documento ", new TRequiredValidator()); 
        $preferencia_habilidade_pessoa_habilidade_id->addValidation("Habilidade id", new TRequiredListValidator()); 

        $system_user->enableSearch();
        $preferencia_habilidade_pessoa_habilidade_id->enableSearch();

        $id->setEditable(false);
        $documento->setEditable(false);
        $system_user->setEditable(false);

        $id->setSize(100);
        $documento->setSize('100%');
        $system_user->setSize('100%');
        $preferencia_habilidade_pessoa_habilidade_id->setSize('100%');

        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null, '100%'),$id],[new TLabel("Usuário do Sistema:", '#000000', '14px', null, '100%'),$system_user],[new TLabel("CPF:", '#000000', '14px', null, '100%'),$documento]);
        $row1->layout = ['col-sm-2','col-sm-5',' col-sm-5'];

        $row2 = $this->form->addFields([$this->fieldList_pessoa_habilidade]);
        $row2->layout = [' col-sm-12'];

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave'],['static' => 1]), 'fas:save #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');
        $this->btn_onclear = $btn_onclear;

        $btn_onshow = $this->form->addAction("Voltar", new TAction(['PessoaList', 'onShow']), 'fas:arrow-left #000000');
        $this->btn_onshow = $btn_onshow;

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        if(empty($param['target_container']))
        {
            $container->add(TBreadCrumb::create(["Usuário","Cadastro de Habilidades"]));
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

            $object = new Pessoa(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            $object->store(); // save the object 

            $loadPageParam = [];

            if(!empty($param['target_container']))
            {
                $loadPageParam['target_container'] = $param['target_container'];
            }

            $preferencia_habilidade_pessoa_items = $this->storeItems('PreferenciaHabilidade', 'pessoa_id', $object, $this->fieldList_pessoa_habilidade, function($masterObject, $detailObject){ 

                //code here

            }, $this->criteria_fieldList_pessoa_habilidade); 

            // get the generated {PRIMARY_KEY}
            $data->id = $object->id; 

            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            TToast::show('success', "Registro salvo", 'topRight', 'far:check-circle');
            TApplication::loadPage('VagaList', 'onShow', $loadPageParam); 

            TForm::sendData(self::$formName, (object)['id' => $object->id]);

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
            TTransaction::open(self::$database); // open a transaction

            if(!empty(TSession::getValue("userid")))
            {
                $pessoa = PessoaService::getPessoaFromSystemUser(TSession::getValue("userid"));
            }

            if ($pessoa)
            {
                $key = $pessoa->id;  // get the parameter $key

                $object = new Pessoa($key); // instantiates the Active Record 

                $this->fieldList_pessoa_habilidade_items = $this->loadItems('PreferenciaHabilidade', 'pessoa_id', $object, $this->fieldList_pessoa_habilidade, function($masterObject, $detailObject, $objectItems){ 

                    //code here

                }, $this->criteria_fieldList_pessoa_habilidade); 


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

        $this->fieldList_pessoa_habilidade->addHeader();
        $this->fieldList_pessoa_habilidade->addDetail($this->default_item_fieldList_pessoa_habilidade);

        $this->fieldList_pessoa_habilidade->addCloneAction(null, 'fas:plus #69aa46', "Clonar");

    }

    public function onShow($param = null)
    {
        $this->fieldList_pessoa_habilidade->addHeader();
        $this->fieldList_pessoa_habilidade->addDetail($this->default_item_fieldList_pessoa_habilidade);

        $this->fieldList_pessoa_habilidade->addCloneAction(null, 'fas:plus #69aa46', "Clonar");

    } 

    public static function getFormName()
    {
        return self::$formName;
    }

}

