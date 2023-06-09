<?php

    //include "Film.php; ako ne postoji fajl, samo ignorisi
    //include_once "Film.php; isto kao include, ali ako je ovaj falj vec ukljucen, onda ga ne ukljucuj pononovo
    //require "Film.php; ako ne postoji fajl, prijavljuje gresku
    //require_once "Film.php; isto kao require, ali ako je ovaj fajl vec ukljucen, onda ga ne ukljucuj ponovo

    require_once "Film.php";
    

    $f1 = new Film("LOTR", 2001, "Peter Jackson", [7.6, 5.4, 4.3]);
    $f1->stampaj();

    $f2 = new Film("Kill Bill", 2003, "Quentin Tarantino", [7.9, 9.4, 3.3]);
    $f2->stampaj();

    $f3 = new Film("Titanik", 1999, "James Cameron", [8.6, 5.4, 5.3]);

    $f3->stampaj();

    // $filmoviTemp = [
    //     $n1= ["naslov" => "LOTR", "godinaIzdanja" => 2001, "reziser" => "Peter Jackson"],
    //     $n2 =["naslov" => "Kill Bill", "godinaIzdanja" => 2003, "reziser" => "PJ"],
    //     $n3 = ["naslov" => "Titanik", "godinaIzdanja" => 1999, "reziser" => "James Cameron"],
    // ];
    // $filmoviTemp = [$n1, $n2, $n3];
    $filmovi = [$f1, $f2, $f3];

    foreach($filmovi as $film) {
        $film->stampaj();
    }

    function prosecnaOcena($films) {
        $zbir = 0;
        foreach($films as $f) {
            $zbir += $f->prosek();
        }
        $n = count($films);
        if($n > 0) {
            return $zbir / $n;
        }else {
            return 0;
        }
    }
    $prosecna = prosecnaOcena($filmovi);
    echo "<p>Prosecna ocena svih filmova jednaka je: $prosecna</p>";

    function vekFilmova($films, $vek) {
        foreach($films as $film) {
            $godinaIzdanja = $film->getGodinaIzdanja();
            
            $vekIzdanja = ceil($godinaIzdanja / 100);

            if($vekIzdanja == $vek) {
                $film->stampaj();
            }
        }
    }
    echo "<p>Filmovi koji su izasli u 21. veku:</p>";
    vekFilmova($filmovi, 21);
    echo "<hr>";

    echo "<p>Filmovi koji su izasli u 20. veku:</p>";
    vekFilmova($filmovi, 20);
    echo "<hr>";


    function osrednjiFilm($niz) {
        $prosek = prosecnaOcena($niz);
        $najblizaVrednost = abs($niz[0]->prosek() - $prosek);
        $najbliziFilm = $niz[0];
        foreach($niz as $film) {
            $vrednost = abs($film->prosek() - $prosek);
            if($vrednost < $najblizaVrednost){
                $najblizaVrednost = $vrednost;
                $najbliziFilm = $film;
            } 
        } return $najbliziFilm;
    }

    $osf = osrednjiFilm($filmovi);
    echo "<p>Film najblizi prosecnoj vrednosti je: </p>";
    $osf->stampaj();
    echo "<hr>";

    function najboljeOcenjeni($niz) {
        $maxOcena = $niz[0]->prosek();
        $maxFilm = $niz[0];

        foreach($niz as $film) {
            $ocena = $film->prosek();
            if($ocena > $maxOcena) { 
                $maxOcena = $ocena;
                $maxFilm = $film;
            }
        } return $maxFilm;
    }
    
    echo "<p>Film sa najboljom ocenoj je: </p>";
    $nof = najboljeOcenjeni($filmovi);
    $nof->stampaj();
    echo "<hr>";

    function najmanjaOcenaNajboljeg($niz) {
        $najboljiFilm = najboljeOcenjeni($niz);
        $sveOcene = $najboljiFilm->getOcene();
        $minOcena = $sveOcene[0];

        foreach($sveOcene as $ocena) {
            if($ocena < $minOcena) {
                $minOcena = $ocena;
            }
        } return $minOcena;
    }

    $minOcena = najmanjaOcenaNajboljeg($filmovi);
    echo "<p>Najmanja ocena najbolje ocenjenog filma je: $minOcena</p>";
    echo "<hr>";

    function najmanjeOcena($niz) {
        $ocenePrvogFilma = $niz[0]->getOcene();
        $minOcena = $ocenePrvogFilma[0];
        foreach($niz as $film) {
            $ocene = $film->getOcene();
            foreach($ocene as $o) {
                if($o < $minOcena) {
                    $minOcena = $o;
                }
            }
        } return $minOcena;
    }

    $mo = najmanjeOcena($filmovi);
    echo "<p>Najmanja ocena koju je neki film dobio je: $mo</p>";

    
?>