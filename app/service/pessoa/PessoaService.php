<?php

class PessoaService
{
    public static function newFromSystemUser(SystemUsers $system_user, array $dados_pessoa)
    {
        TTransaction::open('u316696823_fatec_talent');
        
        $pessoa = new Pessoa();
        $pessoa->system_user = $system_user->id;
        $pessoa->nome= $system_user->name;
        $pessoa->email= $dados_pessoa['email'];
        $pessoa->documento = $dados_pessoa['documento'];
        $pessoa->ativo = $system_user->active;
        $pessoa->pessoa_cadastro_status_id = PessoaCadastroStatus::EM_ANALISE;
        $pessoa->store();
        
        $pessoa_papel = new PessoaPapel();
        $pessoa_papel->pessoa_id = $pessoa->id;
        $pessoa_papel->papel_id = (new Papel($dados_pessoa['tipo_pessoa']))->id;
        $pessoa_papel->store();
        
        TTransaction::close();
        
        return $pessoa_papel;
    }
    
    public static function parseMailEmpresaHTML(Pessoa $pessoa, $status_id, $motivo = null)
    {
        if($status_id == PessoaCadastroStatus::APROVADO)
        {
            $template = new THtmlRenderer('app/resources/pessoas/template_email_cadastro_dados_acesso.html');
            
            $template->enableSection('main', [
                'pessoa_nome' => $pessoa->nome,
                'pessoa_login' => $pessoa->fk_system_user_fatec->login
            ]);

        }
        else
        {
            $template = new THtmlRenderer('app/resources/pessoas/template_email_empresa_reprovado_acesso.html');
            
            $template->enableSection('main', [
                'pessoa_nome' => $pessoa->nome,
                'motivo' => $motivo,
                'numero' => '(11) 5061-5462'
                
            ]);
        }

        return $template->getContents();
    }
    
    public static function onSendEmailCadastroEmpresa(Pessoa $pessoa, $status_id, $motivo = null)
    {
        $emails = [];
        
        //Chamada HTML E-mail Empresa
        $html    = self::parseMailEmpresaHTML($pessoa, $status_id, $motivo);
        $emails[] = $pessoa->email;
        if($status_id == PessoaCadastroStatus::APROVADO)
        {
            $assunto = 'FATEC-Talent - Dados de Acesso ao Portal';
        }
        else
        {
            $assunto = 'FATEC-Talent - Cadastro Reprovado';
        }

        MailService::send($emails, $assunto, $html, 'html');
    }
    
    public static function parseMailCadastroHTML(Pessoa $pessoa)
    {
        $template = new THtmlRenderer('app/resources/pessoas/template_email_cadastro_dados_acesso.html');
        
        //$emitente = new Pessoa(SystemPreferenceService::getIDEmpresa());

        $template->enableSection('main', [
            'pessoa_nome' => $pessoa->nome,
            'pessoa_login' => $pessoa->fk_system_user_fatec->login
        ]);

        return $template->getContents();
    }
    
    public static function onSendEmailCadastro($pessoa_user)
    {
        $emails = [];
        
        //Chamada HTML E-mail Empresa
        $html    = self::parseMailCadastroHTML($pessoa_user, PessoaCadastroStatus::APROVADO);
        $emails[] = $pessoa_user->email;
        $assunto = 'FATEC-Talent - Dados de Acesso ao Portal';

        MailService::send($emails, $assunto, $html, 'html');
    }
    
    public static function getPessoaFromSystemUser($system_users)
    {
        $criteria  = new TCriteria();
        $criteria->add(new TFilter('system_user', '=', $system_users));
        $object = Pessoa::getObjects($criteria);
        
        return ($object) ? array_shift($object) : null; 
    }
    
}