<?php

return function ($kirby, $page, $site) {

    $alert   = null;
    $data    = [];
    $success = false;

    if ($kirby->request()->is('POST') && get('submit')) {

        // Honeypot: bots fill this hidden URL field
        if (get('website') !== null && get('website') !== '') {
            go($page->url());
        }

        $data = [
            'name'    => get('name'),
            'email'   => get('email'),
            'phone'   => get('phone'),
            'subject' => get('subject'),
            'text'    => get('text'),
        ];

        $rules = [
            'name'    => ['required', 'minLength' => 2],
            'email'   => ['required', 'email'],
            'subject' => ['required', 'minLength' => 2],
            'text'    => ['required', 'minLength' => 10, 'maxLength' => 5000],
        ];

        $messages = [
            'name'    => 'Inserisci il tuo nome e cognome.',
            'email'   => 'Inserisci un indirizzo email valido.',
            'subject' => "Inserisci l'oggetto del messaggio.",
            'text'    => 'Inserisci il tuo messaggio (min 10 caratteri).',
        ];

        $invalid = invalid($data, $rules, $messages);

        if ($invalid) {
            $alert = $invalid;
        } else {
            try {
                $kirby->email([
                    'template' => 'contact',
                    'from'     => 'noreply@avvocatozanin.it',
                    'replyTo'  => $data['email'],
                    'to'       => $site->email()->value(),
                    'subject'  => 'Contatto dal sito: ' . esc($data['subject']),
                    'data'     => [
                        'name'    => esc($data['name']),
                        'email'   => esc($data['email']),
                        'phone'   => esc($data['phone']),
                        'subject' => esc($data['subject']),
                        'text'    => esc($data['text']),
                    ],
                ]);
                $success = true;
                $data    = [];
            } catch (Exception $error) {
                $alert['error'] = option('debug')
                    ? $error->getMessage()
                    : "Si e' verificato un errore durante l'invio. Riprova piu' tardi o contattaci telefonicamente.";
            }
        }
    }

    return compact('alert', 'data', 'success');
};
