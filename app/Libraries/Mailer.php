<?php
namespace App\Libraries;
use App\Models\EmailTemplate as Template;
use Mail;
use URL;
Class Mailer {
    public function actionMail($model,$type){
        $template = Template::select('email_templates.*')->find($type);
        $template['subject'] = $this->actionReplace($model,$template->subject);
        $template['description'] = $this->actionReplace($model,$template->description);
        Mail::send('emails.base', [
              'template'  => $template,
              'model' => $model,
        ],function($m) use ($model, $template){
              $m->from($template->from_email, $template->from_name);
              $m->cc($model['cc']);
              // $m->bcc(explode(';',$template->cc));
              $m->subject($template->subject);
              $m->to($model['email']);
        });
    }

    public function actionMailAdmin($model,$type,$subject){
        foreach (Admin::where('subject',$type)->get() as $admin) {
            Mail::send('emails.admin.'.$type , [
                  'model' => $model,
                  'admin' => $admin
            ],function($m) use ($model, $admin, $subject){
                  $m->from('noreply@rotinyaindonesia.com', 'Rotinyaindonesia Web Mailer');
                  $m->subject($subject);
                  $m->to($admin->email);
            });
        }
    }

    public function actionReplace($model,$description){
        $before = array("{{name}}", "{{email}}", "{{nip}}");
        $after  = array($model['nama'], $model['email'], $model['nip']);
        $newphrase = str_replace($before, $after, $description);
        return $newphrase;
    }
}
