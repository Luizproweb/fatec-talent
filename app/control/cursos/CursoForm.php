<?php

class CursoForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'u316696823_fatec_talent';
    private static $activeRecord = 'Curso';
    private static $primaryKey = 'id';
    private static $formName = 'form_CursoForm';

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
        $this->form->setFormTitle("Cadastro de Curso");


        $id = new TEntry('id');
        $codigo = new TEntry('codigo');
        $descricao = new TEntry('descricao');
        $ativo = new TRadioGroup('ativo');
        $curso_area_atuacao_curso_id = new THidden('curso_area_atuacao_curso_id[]');
        $curso_area_atuacao_curso___row__id = new THidden('curso_area_atuacao_curso___row__id[]');
        $curso_area_atuacao_curso___row__data = new THidden('curso_area_atuacao_curso___row__data[]');
        $curso_area_atuacao_curso_area_atuacao_id = new TDBCombo('curso_area_atuacao_curso_area_atuacao_id[]', 'u316696823_fatec_talent', 'AreaAtuacao', 'id', '{codigo} - {descricao}','id asc'  );
        $this->fieldList_6554165b1ba88 = new TFieldList();

        $this->fieldList_6554165b1ba88->addField(null, $curso_area_atuacao_curso_id, []);
        $this->fieldList_6554165b1ba88->addField(null, $curso_area_atuacao_curso___row__id, ['uniqid' => true]);
        $this->fieldList_6554165b1ba88->addField(null, $curso_area_atuacao_curso___row__data, []);
        $this->fieldList_6554165b1ba88->addField(new TLabel("Selecione a Área de Atuação", null, '14px', null), $curso_area_atuacao_curso_area_atuacao_id, ['width' => '100%']);

        $this->fieldList_6554165b1ba88->width = '100%';
        $this->fieldList_6554165b1ba88->setFieldPrefix('curso_area_atuacao_curso');
        $this->fieldList_6554165b1ba88->name = 'fieldList_6554165b1ba88';

        $this->criteria_fieldList_6554165b1ba88 = new TCriteria();
        $this->default_item_fieldList_6554165b1ba88 = new stdClass();

        $this->form->addField($curso_area_atuacao_curso_id);
        $this->form->addField($curso_area_atuacao_curso___row__id);
        $this->form->addField($curso_area_atuacao_curso___row__data);
        $this->form->addField($curso_area_atuacao_curso_area_atuacao_id);

        $this->fieldList_6554165b1ba88->setRemoveAction(null, 'fas:times #dd5a43', "Excluír");

        $codigo->addValidation("Código ", new TRequiredValidator()); 
        $descricao->addValidation("Descrição ", new TRequiredValidator()); 
        $ativo->addValidation("Ativo ", new TRequiredValidator()); 
        $curso_area_atuacao_curso_area_atuacao_id->addValidation("Area atuacao id", new TRequiredListValidator()); 

        $id->setEditable(false);
        $codigo->setMaxLength(4);
        $ativo->addItems(["S"=>"Sim","N"=>"Não"]);
        $ativo->setLayout('horizontal');
        $ativo->setValue('S');
        $ativo->setUseButton();
        $curso_area_atuacao_curso_area_atuacao_id->enableSearch();
        $id->setSize(100);
        $ativo->setSize('100%');
        $codigo->setSize('100%');
        $descricao->setSize('100%');
        $curso_area_atuacao_curso_area_atuacao_id->setSize('100%');

        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null, '100%'),$id],[new TLabel("Código :", '#ff0000', '14px', null, '100%'),$codigo],[new TLabel("Descrição :", '#ff0000', '14px', null, '100%'),$descricao],[new TLabel("Ativo :", '#ff0000', '14px', null, '100%'),$ativo]);
        $row1->layout = [' col-sm-2',' col-sm-3',' col-sm-5',' col-sm-2'];

        $row2 = $this->form->addFields([$this->fieldList_6554165b1ba88]);
        $row2->layout = [' col-sm-12'];

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave'],['static' => 1]), 'fas:save #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');
        $this->btn_onclear = $btn_onclear;

        $btn_onshow = $this->form->addAction("Voltar", new TAction(['CursoList', 'onShow']), 'fas:arrow-left #000000');
        $this->btn_onshow = $btn_onshow;

        parent::setTargetContainer('adianti_right_panel');

        $btnClose = new TButton('closeCurtain');
        $btnClose->class = 'btn btn-sm btn-default';
        $btnClose->style = 'margin-right:10px;';
        $btnClose->onClick = "Template.closeRightPanel();";
        $btnClose->setLabel("Fechar");
        $btnClose->setImage('fas:times');

        $this->form->addHeaderWidget($btnClose);

        parent::add($this->form);

    }

    public function onSave($param = null) 
    {
        try
        {
            TTransaction::open(self::$database); // open a transaction

            $messageAction = null;

            $this->form->validate(); // validate form data

            $object = new Curso(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            $object->store(); // save the object 

            $loadPageParam = [];

            if(!empty($param['target_container']))
            {
                $loadPageParam['target_container'] = $param['target_container'];
            }

            $curso_area_atuacao_curso_items = $this->storeItems('CursoAreaAtuacao', 'curso_id', $object, $this->fieldList_6554165b1ba88, function($masterObject, $detailObject){ 

                //code here

            }, $this->criteria_fieldList_6554165b1ba88); 

            // get the generated {PRIMARY_KEY}
            $data->id = $object->id; 

            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            TToast::show('success', "Registro salvo", 'topRight', 'far:check-circle');
            TApplication::loadPage('CursoList', 'onShow', $loadPageParam); 

                        TScript::create("Template.closeRightPanel();");
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
            if (isset($param['key']))
            {
                $key = $param['key'];  // get the parameter $key
                TTransaction::open(self::$database); // open a transaction

                $object = new Curso($key); // instantiates the Active Record 

                $this->fieldList_6554165b1ba88_items = $this->loadItems('CursoAreaAtuacao', 'curso_id', $object, $this->fieldList_6554165b1ba88, function($masterObject, $detailObject, $objectItems){ 

                    //code here

                }, $this->criteria_fieldList_6554165b1ba88); 

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

        $this->fieldList_6554165b1ba88->addHeader();
        $this->fieldList_6554165b1ba88->addDetail($this->default_item_fieldList_6554165b1ba88);

        $this->fieldList_6554165b1ba88->addCloneAction(null, 'fas:plus #69aa46', "Clonar");

    }

    public function onShow($param = null)
    {
        $this->fieldList_6554165b1ba88->addHeader();
        $this->fieldList_6554165b1ba88->addDetail($this->default_item_fieldList_6554165b1ba88);

        $this->fieldList_6554165b1ba88->addCloneAction(null, 'fas:plus #69aa46', "Clonar");

    } 

    public static function getFormName()
    {
        return self::$formName;
    }

}

