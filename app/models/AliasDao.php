<?php

class AliasDao {
    static function getAll() {
        return array(
            0 => array(
                'source' => 'anthony.garcia@momcards.fr',
                'destination' => 'xinu@momcards.fr',
                'etat' => 1
            ),
            1 => array(
                'source' => 'admin@momcards.fr',
                'destination' => 'xinu@momcards.fr,elfaus@momcards.fr',
                'etat' => 1
            ),
        );
    }
}