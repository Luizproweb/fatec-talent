<?php
/**
 * SystemRegistrationForm
 *
 * @version    1.0
 * @package    control
 * @subpackage admin
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
class SystemRegistrationForm extends TPage
{
    protected $form; // form
    protected $program_list;
    private static $formName = 'form_registration';
    
    /**
     * Class constructor
     * Creates the page and the registration form
     */
    function __construct()
    {
        parent::__construct();
        
        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);
        $this->form->setFormTitle( _t('User registration') );
        
        // create the form fields
        $tipo_pessoa = new TRadioGroup('tipo_pessoa'); 
        $login       = new TEntry('login');
        $name        = new TEntry('name');
        $documento   = new TEntry('documento');
        //$email       = new TEntry('email');
        $password    = new TPassword('password');
        $repassword  = new TPassword('repassword');
        
        $this->form->addAction( _t('Save'),  new TAction([$this, 'onSave']), 'far:save')->{'class'} = 'btn btn-sm btn-primary';
        $this->form->addAction( _t('Clear'), new TAction([$this, 'onClear']), 'fa:eraser red' );
        $btn_onshow = $this->form->addAction("Voltar", new TAction(['LoginForm', 'onShow']), 'fas:arrow-left #000000');
        $this->btn_onshow = $btn_onshow;
        
        $tipo_pessoa->addValidation('Tipo Cadastro', new TRequiredValidator);
        //$login->addValidation( _t('e-mail'), new TRequiredValidator);
        $name->addValidation( _t('Name'), new TRequiredValidator);
        $documento->addValidation('CPF/CNPJ', new TRequiredValidator);
        //$email->addValidation( _t('Email'), new TRequiredValidator);
        $password->addValidation( _t('Password'), new TRequiredValidator);
        $password->addValidation("Senha", new TMinLengthValidator(), ["6"]);
        $repassword->addValidation( _t('Password confirmation'), new TRequiredValidator);
        $login->addValidation( _t('e-mail'), new TEmailValidator(), ["e-mail"]);
        
        $tipo_pessoa->addItems(Papel::PAPEIS_CADASTRO);
        $tipo_pessoa->setUseButton(true);
        $tipo_pessoa->setLayout('horizontal');
        // define the sizes
        $name->setSize('100%');
        $documento->setSize('100%');
        $login->setSize('100%');
        $password->setSize('100%');
        $repassword->setSize('100%');
        //$email->setSize('100%');
        $tipo_pessoa->setChangeAction(new TAction([$this,'onChangeTipo']));
        
        //$documento->setExitAction(new TAction([$this,'onVerificaDocumento']));
        
        $this->form->addFields( [new TLabel('Tipo Cadastro', 'red')],[$tipo_pessoa] );
        $this->form->addFields( [new TLabel(_t('Email'), 'red')],    [$login] );
        $this->form->addFields( [new TLabel(_t('Name'), 'red')],     [$name] );
        $this->form->addFields( [new TLabel('CPF/CNPJ', 'red')],    [$documento] );
        //$this->form->addFields( [new TLabel(_t('Email'), 'red')],    [$email] );
        $this->form->addFields( [new TLabel(_t('Password'), 'red')], [$password] );
        $this->form->addFields( [new TLabel(_t('Password confirmation'), 'red')], [$repassword] );
        
        // add the container to the page
        $wrapper = new TElement('div');
        $wrapper->style = 'margin:auto; margin-top:100px;max-width:600px;';
        $wrapper->id    = 'login-wrapper';
        $wrapper->add($this->form);
        
        // add the wrapper to the page
        parent::add($wrapper);
    }
    
    /**
     * Clear form
     */
    public function onClear()
    {
        $this->form->clear( true );
    }
    
    /*public static function onVerificaDocumento($param)
    {
        $key = $param['id'] ?? null;
        $doc = $param['documento'] ?? null;

        if(!$key)
        {
            if ($doc)
            {
                $doc_replace = str_replace(['.','/','-'], '', $doc);

                TTransaction::open('u316696823_fatec_talent');
                $obj = Pessoa::newFromDocumento($doc_replace);
                TTransaction::close();

                if(isset($obj->id))
                {
                    throw new Exception('Documento já cadastrado no sistema.');
                }
            }
        }
    }*/
    
    public static function onChangeTipo($param)
    {
        if ($param['tipo_pessoa'] == Papel::EMPRESA)
        {
            TEntry::changeMask(self::$formName, 'documento', '99.999.999/9999-99');
        }
        else
        {
            TEntry::changeMask(self::$formName, 'documento', '999.999.999-99');
        }
    }
    
    /**
     * method onSave()
     * Executed whenever the user clicks at the save button
     */
    public static function onSave($param)
    {
        try
        {
            $ini = AdiantiApplicationConfig::get();
            if ($ini['permission']['user_register'] !== '1')
            {
                throw new Exception( _t('The user registration is disabled') );
            }
            
            // open a transaction with database 'permission'
            TTransaction::open('u316696823_fatec_talent');
            
            if( empty($param['tipo_pessoa']) )
            {
                throw new Exception(TAdiantiCoreTranslator::translate('The field ^1 is required', 'Tipo Cadastro'));
            }
            
            if( empty($param['login']) )
            {
                throw new Exception(TAdiantiCoreTranslator::translate('The field ^1 is required', _t('Login')));
            }
            
            if( empty($param['name']) )
            {
                throw new Exception(TAdiantiCoreTranslator::translate('The field ^1 is required', _t('Name')));
            }
            
            if( empty($param['documento']) )
            {
                throw new Exception(TAdiantiCoreTranslator::translate('The field ^1 is required', 'Documento'));
            }
            
            /*if( empty($param['email']) )
            {
                throw new Exception(TAdiantiCoreTranslator::translate('The field ^1 is required', _t('Email')));
            }*/
            
            if( empty($param['password']) )
            {
                throw new Exception(TAdiantiCoreTranslator::translate('The field ^1 is required', _t('Password')));
            }
            
            if(strlen($param['password']) < 6) 
            {
               throw new Exception('Digite uma senha com um valor mínimo de 6 caracteres'); 
            }
            
            if( empty($param['repassword']) )
            {
                throw new Exception(TAdiantiCoreTranslator::translate('The field ^1 is required', _t('Password confirmation')));
            }
            
            if (SystemUsers::newFromLogin($param['login']) instanceof SystemUsers)
            {
                throw new Exception(_t('An user with this login is already registered'));
            }
            
            TTransaction::open('u316696823_fatec_talent');
            
            if (Pessoa::newFromDocumento($param['documento']) instanceof Pessoa)
            {
                throw new Exception('Já existe um Usuário cadastrado com este CPF/CNPJ');
            }
            
            TTransaction::close();
            
            /*if (SystemUsers::newFromEmail($param['email']) instanceof SystemUsers)
            {
                throw new Exception(_t('An user with this e-mail is already registered'));
            }*/
            
            if( $param['password'] !== $param['repassword'] )
            {
                throw new Exception(_t('The passwords do not match'));
            }
            
            if(isset($param['tipo_pessoa']) and $param['tipo_pessoa'])
            {
                if($param['tipo_pessoa'] == Papel::EMPRESA)
                {
                    $validate_cnpj = new TCNPJValidator();
                    $validate_cnpj->validate('CNPJ', $param['documento']);
                }
                else
                {
                    $validate_cpf = new TCPFValidator();
                    $validate_cpf->validate('CPF', $param['documento']);
                }
            }
            
            if(isset($param['login']) and $param['login'])
            {
                $validate_email = new TEmailValidator();
                $validate_email->validate('EMAIL', $param['login']);
            }
            
            $object = new SystemUsers;
            $object->active = ((isset($param['tipo_pessoa'])) AND ($param['tipo_pessoa'] == Papel::CANDIDATO)) ? 'Y' : 'N';
            $object->fromArray( $param );
            $object->password = md5($object->password);
            $object->email = $param['login'];
            if($param['tipo_pessoa'] == Papel::EMPRESA)
            {
                $object->frontpage_id = 27;
            }
            else
            {
                 $object->frontpage_id = 26;
            }
            #$object->frontpage_id = $ini['permission']['default_screen'];
            $object->clearParts();
            $object->store();
            
            $dados_pessoa = [
                'tipo_pessoa' => $param['tipo_pessoa'],
                'documento' => $param['documento'],
                'email' => $param['login']
            ];
            
            $pessoa_papel =  PessoaService::newFromSystemUser($object, $dados_pessoa);
            
            if($pessoa_papel->papel_id == Papel::EMPRESA)
            {
                new TMessage('info', 'Cadastro realizado com sucesso, em breve você receberá os dados de acesso via E-mail.');
            }
            
            //Adiciona Grupo ao Cadastrar Usuário de acordo com seu Papel.
            if($pessoa_papel->papel_id == Papel::EMPRESA)
            {
                $defaulGroups =' 2,7';
            }
            else
            {
                $defaulGroups = '2,6';
            }
            
            #$defaulGroups = $ini['permission']['default_groups'] ?? 2;
            
            $default_groups = explode(',', $defaulGroups);
            
            if( count($default_groups) > 0 )
            {
                foreach( $default_groups as $group_id )
                {
                    $object->addSystemUserGroup( new SystemGroup($group_id) );
                }
            }
            
            if(!empty($ini['permission']['default_units']))
            {
                $default_units = explode(',', $ini['permission']['default_units']);
            
                if( count($default_units) > 0 )
                {
                    foreach( $default_units as $unit_id )
                    {
                        $object->addSystemUserUnit( new SystemUnit($unit_id) );
                    }
                }
            }
            
            TTransaction::close(); // close the transaction
            
            
            if($pessoa_papel->papel_id == Papel::CANDIDATO)
            {
                TTransaction::open('u316696823_fatec_talent');
                
                $pessoa = Pessoa::where('system_user', '=', $object->id )->load();
                PessoaService::onSendEmailCadastro($pessoa[0]);
                
                TTransaction::close();
            }
            $pos_action = new TAction(['LoginForm', 'onLoad']);
            new TMessage('info', _t('Account created'), $pos_action); // shows the success message
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
            TTransaction::rollback();
        }
    }
    
    public function onShow($param)
    {

        //<onShow>

        //</onShow>
    }
}
