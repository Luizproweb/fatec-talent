<?php

class PapelForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'u316696823_fatec_talent';
    private static $activeRecord = 'Papel';
    private static $primaryKey = 'id';
    private static $formName = 'form_PapelForm';

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
        $this->form->setFormTitle("Cadastro de Papel");


        $id = new TEntry('id');
        $descricao = new TEntry('descricao');
        $ativo = new TRadioGroup('ativo');

        $ativo->addValidation("Ativo ", new TRequiredValidator()); 

        $id->setEditable(false);
        $ativo->addItems(["S"=>"Sim","N"=>"Não"]);
        $ativo->setLayout('horizontal');
        $ativo->setValue('S');
        $ativo->setUseButton();
        $id->setSize(100);
        $ativo->setSize('100%');
        $descricao->setSize('100%');

        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null, '100%'),$id],[new TLabel("Codigo:", null, '14px', null, '100%'),$descricao],[new TLabel("Ativo :", '#ff0000', '14px', null, '100%'),$ativo]);
        $row1->layout = [' col-sm-2',' col-sm-6',' col-sm-4'];

        // create the form actions
        $btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');
        $this->btn_onclear = $btn_onclear;

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

    public function onEdit( $param )
    {
        try
        {
            if (isset($param['key']))
            {
                $key = $param['key'];  // get the parameter $key
                TTransaction::open(self::$database); // open a transaction

                $object = new Papel($key); // instantiates the Active Record 

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

