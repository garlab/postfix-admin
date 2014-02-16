<?php

class ComptesDao {
    static function getAll() {
        return array(
            0 => array(
                'email' => 'foo@baz.com',
                'password' => 'X>kjzdszs',
                'quota' => '0',
                'etat' => '1',
                'imap' => '1',
                'pop3' => '1'
            ),
            1 => array(
                'email' => 'lorem.ipsum@domain.tld',
                'password' => 'p@ssw0rd',
                'quota' => '0',
                'etat' => '1',
                'imap' => '1',
                'pop3' => '1'
            )
        );
    }
}