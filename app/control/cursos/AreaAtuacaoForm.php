<?php

class AreaAtuacaoForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'u316696823_fatec_talent';
    private static $activeRecord = 'AreaAtuacao';
    private static $primaryKey = 'id';
    private static $formName = 'form_AreaAtuacaoForm';

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
        $this->form->setFormTitle("Cadastro de Área de Atuação");


        $id = new TEntry('id');
        $codigo = new TEntry('codigo');
        $descricao = new TEntry('descricao');
        $ativo = new TRadioGroup('ativo');
        $area_atuacao_habilidade_area_atuacao_id = new THidden('area_atuacao_habilidade_area_atuacao_id[]');
        $area_atuacao_habilidade_area_atuacao___row__id = new THidden('area_atuacao_habilidade_area_atuacao___row__id[]');
        $area_atuacao_habilidade_area_atuacao___row__data = new THidden('area_atuacao_habilidade_area_atuacao___row__data[]');
        $area_atuacao_habilidade_area_atuacao_habilidade_id = new TDBCombo('area_atuacao_habilidade_area_atuacao_habilidade_id[]', 'u316696823_fatec_talent', 'Habilidade', 'id', '{codigo} - {descricao}','id asc'  );
        $this->fieldList_65541a7d1ba90 = new TFieldList();

        $this->fieldList_65541a7d1ba90->addField(null, $area_atuacao_habilidade_area_atuacao_id, []);
        $this->fieldList_65541a7d1ba90->addField(null, $area_atuacao_habilidade_area_atuacao___row__id, ['uniqid' => true]);
        $this->fieldList_65541a7d1ba90->addField(null, $area_atuacao_habilidade_area_atuacao___row__data, []);
        $this->fieldList_65541a7d1ba90->addField(new TLabel("Selecione as Habilidades", null, '14px', null), $area_atuacao_habilidade_area_atuacao_habilidade_id, ['width' => '100%']);

        $this->fieldList_65541a7d1ba90->width = '100%';
        $this->fieldList_65541a7d1ba90->setFieldPrefix('area_atuacao_habilidade_area_atuacao');
        $this->fieldList_65541a7d1ba90->name = 'fieldList_65541a7d1ba90';

        $this->criteria_fieldList_65541a7d1ba90 = new TCriteria();
        $this->default_item_fieldList_65541a7d1ba90 = new stdClass();

        $this->form->addField($area_atuacao_habilidade_area_atuacao_id);
        $this->form->addField($area_atuacao_habilidade_area_atuacao___row__id);
        $this->form->addField($area_atuacao_habilidade_area_atuacao___row__data);
        $this->form->addField($area_atuacao_habilidade_area_atuacao_habilidade_id);

        $this->fieldList_65541a7d1ba90->setRemoveAction(null, 'fas:times #dd5a43', "Excluír");

        $area_atuacao_habilidade_area_atuacao_habilidade_id->addValidation("Habilidades id", new TRequiredListValidator()); 

        $id->setEditable(false);
        $ativo->addItems(["S"=>"Sim","N"=>"Não"]);
        $ativo->setLayout('horizontal');
        $ativo->setValue('S');
        $ativo->setUseButton();
        $area_atuacao_habilidade_area_atuacao_habilidade_id->enableSearch();
        $id->setSize(100);
        $ativo->setSize('100%');
        $codigo->setSize('100%');
        $descricao->setSize('100%');
        $area_atuacao_habilidade_area_atuacao_habilidade_id->setSize('100%');

        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null, '100%'),$id]);
        $row1->layout = [' col-sm-2'];

        $row2 = $this->form->addFields([new TLabel("Código :", null, '14px', null, '100%'),$codigo],[new TLabel("Descrição :", null, '14px', null, '100%'),$descricao],[new TLabel("Ativo :", null, '14px', null, '100%'),$ativo]);
        $row2->layout = [' col-sm-3',' col-sm-6',' col-sm-3'];

        $row3 = $this->form->addFields([$this->fieldList_65541a7d1ba90]);
        $row3->layout = [' col-sm-12'];

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave'],['static' => 1]), 'fas:save #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');
        $this->btn_onclear = $btn_onclear;

        $btn_onshow = $this->form->addAction("Voltar", new TAction(['AreaAtuacaoList', 'onShow']), 'fas:arrow-left #000000');
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

            $object = new AreaAtuacao(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            $object->store(); // save the object 

            $loadPageParam = [];

            if(!empty($param['target_container']))
            {
                $loadPageParam['target_container'] = $param['target_container'];
            }

            $area_atuacao_habilidade_area_atuacao_items = $this->storeItems('AreaAtuacaoHabilidade', 'area_atuacao_id', $object, $this->fieldList_65541a7d1ba90, function($masterObject, $detailObject){ 

                //code here

            }, $this->criteria_fieldList_65541a7d1ba90); 

            // get the generated {PRIMARY_KEY}
            $data->id = $object->id; 

            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            TToast::show('success', "Registro salvo", 'topRight', 'far:check-circle');
            TApplication::loadPage('AreaAtuacaoList', 'onShow', $loadPageParam); 

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

                $object = new AreaAtuacao($key); // instantiates the Active Record 

                $this->fieldList_65541a7d1ba90_items = $this->loadItems('AreaAtuacaoHabilidade', 'area_atuacao_id', $object, $this->fieldList_65541a7d1ba90, function($masterObject, $detailObject, $objectItems){ 

                    //code here

                }, $this->criteria_fieldList_65541a7d1ba90); 

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

        $this->fieldList_65541a7d1ba90->addHeader();
        $this->fieldList_65541a7d1ba90->addDetail($this->default_item_fieldList_65541a7d1ba90);

        $this->fieldList_65541a7d1ba90->addCloneAction(null, 'fas:plus #69aa46', "Clonar");

    }

    public function onShow($param = null)
    {
        $this->fieldList_65541a7d1ba90->addHeader();
        $this->fieldList_65541a7d1ba90->addDetail($this->default_item_fieldList_65541a7d1ba90);

        $this->fieldList_65541a7d1ba90->addCloneAction(null, 'fas:plus #69aa46', "Clonar");

    } 

    public static function getFormName()
    {
        return self::$formName;
    }

}

