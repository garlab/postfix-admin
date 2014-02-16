<?php

class DomainesDao {
    static function getAll() {
        return array(
            0 => array(
                'name' => 'narwhal.pl',
                'etat' => 1
            ),
            1 => array(
                'name' => 'momcards.fr',
                'etat' => 1
            )
        );
    }
}