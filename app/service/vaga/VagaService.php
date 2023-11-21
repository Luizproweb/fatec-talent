<?php

class VagaService
{
    public static function parseMailCandidatoHTML(Vaga $vaga)
    {
        $template = new THtmlRenderer('app/resources/pessoas/template_email_candidato.html');
        //$emitente = new Pessoa(SystemPreferenceService::getIDEmpresa());

        $template->enableSection('main', [
            'vaga_descricao' => $vaga->observacao
            //'emitente' => $emitente->nome
        ]);

        return $template->getContents();
    }
    
    public static function parseMailEmpresaHTML(Vaga $vaga)
    {
        $template = new THtmlRenderer('app/resources/pessoas/template_email_empresa.html');
        //$emitente = new Pessoa(SystemPreferenceService::getIDEmpresa());

        $template->enableSection('main', [
            'vaga_descricao' => $vaga->observacao
            //'emitente' => $emitente->nome
        ]);

        return $template->getContents();
    }
    
    public static function onSendEmailVaga($vaga, $pessoa)
    {
        //Chamada HTML E-mail Empresa
        $html    = self::parseMailEmpresaHTML($vaga);
        //$html    = 'Segue em anexo currículo para vaga';
        $emails  = $vaga->pessoa->email;
        $assunto = 'FATEC-Talent - Candidatura Vaga: ' . $vaga->id;
        
        $curriculo = $pessoa->anexo_curriculo;
        $split_curriculo = explode('/', $curriculo);
        $nome_arquivo = end($split_curriculo);
        $extensao = explode('.', $nome_arquivo);

        MailService::send($emails, $assunto, $html, 'html', [[$curriculo, $nome_arquivo . end($extensao)]]);
        
        //Chamada HTML E-mail Candidato
        $html    = self::parseMailCandidatoHTML($vaga);
        //$html    = 'Segue em anexo currículo para vaga';
        $emails  = $pessoa->email;
        $assunto = 'FATEC-Talent - Candidatura Vaga: ' . $vaga->id;
        
        $curriculo = $pessoa->anexo_curriculo;

        MailService::send($emails, $assunto, $html, 'html');
    }
    
    public static function canEdit()
    {
        $grupos = TSession::getValue('usergroupids');
        $grupos_editar = [1 , 7];
        //$usuario = TSession::getValue('userid');
        
        $can_editar = array_intersect($grupos_editar, $grupos);
        
        if ($can_editar)
        {
            return true;
        }
        else
        {
            return false;
        }
        
    }
    
    public static function canExcluir()
    {
        $grupos = TSession::getValue('usergroupids');
        $grupos_excluir = [1 , 7];
        //$usuario = TSession::getValue('userid');
        
        $can_excluir = array_intersect($grupos_excluir, $grupos);
        
        if ($can_excluir)
        {
            return true;
        }
        else
        {
            return false;
        }
        
    }
    
    public static function canAtivaDesativa()
    {
        $grupos = TSession::getValue('usergroupids');
        $grupos_ativar_desativar = [1 , 7];
        //$usuario = TSession::getValue('userid');
        
        $can_desativa_ativa = array_intersect($grupos_ativar_desativar, $grupos);
        
        if ($can_desativa_ativa)
        {
            return true;
        }
        else
        {
            return false;
        }
        
    }
    
}