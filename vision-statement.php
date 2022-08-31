<?php
require_once("require.php");    
require_once(INCLUDED_FILES . "config.inc.php");
require_once(INCLUDED_FILES . "dbConn.php");
require_once(INCLUDED_FILES . "functionsInc.php");
$conn = dbconnect();
$title = "Contact Us";
include(INC_FOLDER . "homeheaderInc.php");
?>

<section class="testimonials vision-statement">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="testimonials-inner">
                        <div class="visual-title">
                            Vision Statement
                        </div>
                        <div class="visual-content">
                            As I begin to write this statement I wonder what adjectives can aptly qualify the word 'vision'. Should it be 'achievable' - 'time-bound'. Should it be divided into concrete steps to pave a path towards an intended destination. Should the vision follow norms that a market dictates strictly or just heed it's words to balance the tightrope between the pursuit of wealth and an endeavour towards knowledge.
                        </div>
                        <div class="visual-content">
                            One is certain about the fact that the vision should be reviewable, for charting new paths can create wondrous moments. Starting in 1993, my joyous journey into the world of art has left me enriched in more ways than one. It has provided a livelihood that has sustained me and allowed me to grow personally. Gallery Rasa Archives is moulded by all that I have received in this journey and I shall strive to make it richer and more accessible to an increasingly like-minded people.
                        </div>
                        <div class="visual-content">
                            Exhibitions are the life-blood of any gallery space, virtual or otherwise and over the last two decades the gallery has represented itself with a few, important and path breaking exhibitions. We intend to focus our efforts even further in this regard.
                        </div>
                        <div class="visual-content">
                            Over the years, I have realized the importance of collaborations, and the intent is to foray deep in this direction, both to enrich the archive and create opportunities for exhibitions, commercial and otherwise.
                        </div>
                        <div class="visual-content">
                            This journey till now and the exciting possibilities that lies ahead has been made possible by numerous friends, collaborators, artists, art historians, galleries and of course, my wife Radhika - my partner in all I do.
                        </div>
                        <div class="visual-content">
                            The learning process continues......
                        </div>
                        <div class="visual-name">
                            Rakesh Sahni
                        </div>
                        <div class="visual-director">
                            Director - Gallery Rasa
                        </div>
                    </div>
                     </div>
                    <div class="col-lg-6">
                        <div class="vision-img">
                        </div>
                    </div>           
            </div>
        </div>
    </section>

<?php
include(INC_FOLDER . "footerInc.php");
?>