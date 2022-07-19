<?php

/*
 * Format author name
 */

function csAuthorformat($contributors) {
    $html = '';
    if (strpos($contributors, ',') !== false) {
        $authors = explode(",", $contributors);
    }else{
        $authors = array($contributors);
    }
    
    $countAuthors = 0;
    $Countcontributors = count($authors);
    
    foreach ($authors as $author){
        $countAuthors++;
    }
    
    for ($i = 0; $i < $Countcontributors; $i++) {
        $authorName = split_name($authors[$i]);
        if ($i == 0) {
            //First time through the loop
            if ($countAuthors > 1) {
                //There is more than one author
                $html .= uppercasewords($authorName['sn']);
                
                if ($authorName['fn'] || $authorName['mi']) {
                    $html .= ", " . uppercasefirstword($authorName['fn']);
                    
                    if(!empty($authorName['mi'])){
                        $html .= ' ' . uppercasewords($authorName['mi']) . ', ';
                    }else{
                        $html .= ', ';
                    }
                     
                } else {
                    //The author name is a corporation not a person
                    $html .= ', ';
                }
            } else {
                //There is only one author
                
                if ($authorName['sn'] != 'Anonymous' || (!$authorName['sn'] && !$authorName['fn'] && !$authorName['mi'])) {
                    //The Author is not Anonymous or blank
                    $html .= uppercasewords($authorName['sn']);
                    if ($authorName['fn'] || $authorName['mi']) {
                        $html .= ', ' . $authorName['fn'];
                        if ($authorName['mi']) {
			$html .= " ". uppercasewords($authorName['mi']) . '. ';
                        }else{
                            $html .= ".";
                        }
                        
                    } else {
                        $html .= ', ';
                    }
                }
            }
        }else{
            if(($i+1) == $countAuthors){
                //This is the last time thorigh the loop
                
                if($countAuthors > 1 ){
                    $authorName = split_name(cleanvars($authors[$i]));
                    $html .= " and " . uppercasewords($authorName['fn']);
                    if ($authorName['sn'] || $authorName['mi']) {
                        
                         if($authorName['mi']){
                            $html .= ' '. uppercasefirstword($authorName['mi']) . ' ';
                        }else{
                            $html .= ' ';
                        }
                        
                        $html .= uppercasefirstword($authorName['sn']) . '.';
                        
                    }else{
                        //The author is a corporation and not a person
                        $html .= '. ';
                    }
                    
                }else{
                //There is only one Author
                
                if ($authorName['sn'] != 'Anonymous' || (!$authorName['sn'] && !$authorName['fn'] && !$authorName['mi'])) {
                    //The Author is not Anonymous or blank
                    $html .= uppercasewords($authorName['sn']);
                    if ($authorName['fn']) {
                        $html .= ', ' . $authorName['fn'];

                        if (!empty($authorName['mi'])) {
                            $html .= ' ' . uppercasewords($authorName['mi']) . '. ';
                        }
                    } else {
                        $html .= '. ';
                    }
                }
            }
            }else{
                $authorName = split_name($authors[$i]);
                
                $html .= uppercasewords($authorName['fn']);
                
                if ($authorName['sn'] || $authorName['mi']) {
                    if($authorName['mi']){
                            $html .= ' '. uppercasefirstword($authorName['mi']) . ' ';
                        }else{
                            $html .= ' ';
                        }
                        
                        $html .= uppercasefirstword($authorName['sn']) . ', ';
                } else {
                    //The author name is a corporation not a person
                    $html .= ', ';
                }
            }
        }
    }
    return $html;
}

function CSLtranlator($contributors){
    $html = '';
    if (strpos($contributors, ',') !== false) {
        $translators = explode(",", $contributors);
    }else{
        $translators = array($contributors);
    }
    
    
    $countTranslator = 0;
    $Countcontributors = count($translators);
    foreach ($translators as $translator){
        $countTranslator++;
    }
    
    for ($i = 0; $i < $Countcontributors; $i++) {
        $translatorName = split_name($translators[$i]);
        if ($i == 0) {
            //First time through the loop
            if ($countTranslator > 1) {
                //There is more than one author
                
                
                $html .= uppercasewords($translatorName['sn']);
                
                if ($translatorName['fn']) {
                    $html .= ", " . uppercasefirstword($translatorName['fn']) . ',';
                     
                } else {
                    //The author name is a corporation not a person
                    $html .= ', ';
                }
            } else {
                //There is only one author
                if ($translatorName['sn'] != 'Anonymous' || (!$translatorName['sn'] && !$translatorName['fn'])) {
                    //The Author is not Anonymous or blank
                    $html .= uppercasewords($translatorName['sn']);
                    if ($translatorName['fn'] || $translatorName['mi']) {
                        $html .= ', ' . $translatorName['fn'] . '. ';

                        
                    } else {
                        $html .= ', ';
                    }
                }
            }
        }else{
            if(($i+1) == $countTranslator){
                //This is the last time thorigh the loop
                if($countTranslator > 1 ){
                    $translatorName = split_name(cleanvars($translators[$i]));
                    $html .= " and " . uppercasewords($translatorName['fn']);
                    if (!empty($translatorName['sn']) || !empty($translatorName['fn'])) {
                        
                        $html .= ' ' . uppercasefirstword($translatorName['sn']) . '.';
                        
                        $html .= ' ';
                    }else{
                        //The author is a corporation and not a person
                        $html .= '. ';
                    }
                    
                }else{
                //There is only one Author
                //There is only one author
                if ($translatorName['sn'] != 'Anonymous' || (!$translatorName['sn'] && !$translatorName['fn'])) {
                    //The Author is not Anonymous or blank
                    $html .= uppercasewords($translatorName['sn']);
                    if ($translatorName['fn']) {
                        $html .= ', ' . $translatorName['fn'] . '. ';

                        if (!empty($translatorName['mi'])) {
                            $html .= ' ' . uppercasewords($translatorName['mi']) . '. ';
                        }
                    } else {
                        $html .= ', ';
                    }
                }
            }
            }else{
                $translatorName = split_name($translators[$i]);
                
                $html .= uppercasewords($translatorName['fn']);
                
                if ($translatorName['sn'] || $translatorName['mi']) {
                    $html .= ", " . uppercasefirstword($translatorName['fn']) . ',';
                    if (!empty($translatorName['mi'])) {
                        $html .= ' ' . uppercasewords($translatorName['mi']) . '., ';
                    } else {
                        $html .= ', ';
                    }
                } else {
                    //The author name is a corporation not a person
                    $html .= ', ';
                }
            }
        }
    }
    return $html;
}

function CSLeditor($contributors){
    $html = '';
    if (strpos($contributors, ',') !== false) {
        $editors = explode(",", $contributors);
    }else{
        $editors = array($contributors);
    }
    
    
    $countEditor = 0;
    $Counteditor = count($editors);
    foreach ($editors as $editor){
        $countEditor++;
    }
    
    for ($i = 0; $i < $Counteditor; $i++) {
        $editorName = split_name($editors[$i]);
        if ($i == 0) {
            //First time through the loop
            if ($countEditor > 1) {
                //There is more than one author
                
                
                $html .= uppercasewords($editorName['sn']);
                
                if ($editorName['fn']) {
                    $html .= ", " . uppercasefirstword($editorName['fn']) . ',';
                     if($editorName['mi']){
                         $html .= ' '. uppercasefirstword($editorName['mi']) . '.';
                     }
                     $html .= 'editor. ';
                } else {
                    //The author name is a corporation not a person
                    $html .= ', ';
                }
            } else {
                //There is only one author
                if ($editorName['sn'] != 'Anonymous' || (!$editorName['sn'] && !$editorName['fn'] && !$editorName['mi'])) {
                    //The Author is not Anonymous or blank
                    $html .= uppercasewords($editorName['sn']);
                    if ($editorName['fn'] || $editorName['mi']) {
                        $html .= ', ' . $editorName['fn'] . ', ';
                        if($editorName['mi']){
                            $html .= ' '.uppercasefirstword($editorName['mi']) . '';
                        }
                            $html .= 'editor. ';
                        
                        
                    } 
                }
            }
        }else{
            if(($i+1) == $countEditor){
                //This is the last time thorigh the loop
                if($countEditor > 1 ){
                    $editorName = split_name($editors[$i]);
                    $html .= " and " . uppercasewords($editorName['fn']);
                    if ($editorName['sn'] || $editorName['mi']) {
                        
                        $html .= ' ' . uppercasefirstword($editorName['sn']) . ', ';
                        if($editorName['mi']){
                            $html .= ' ' . uppercasefirstword($editorName['mi']) . 'editor. ';
                        }
                        $html .= 'editor. ';
                      
                        
                    }
                }else{
                //There is only one Author
                
                if ($editorName['sn'] != 'Anonymous' || (!$editorName['sn'] && !$editorName['fn'] && !$editorName['mi'])) {
                    //The Author is not Anonymous or blank
                    $html .= uppercasewords($editorName['sn']);
                    if ($editorName['fn']) {
                        $html .= ', ' . $editorName['fn'] . ', ';
                        if($editorName['mi']){
                            $html .= uppercasefirstword($editorName['mi']) . ' editor. ';
                        }
                        
                    } else {
                        $html .= ' editor.  ';
                    }
                }
            }
            }else{
                $editorName = split_name($editors[$i]);
                
                $html .= uppercasewords($editorName['fn']);
                
                if ($editorName['fn']) {
                    $html .= ", " . uppercasefirstword($editorName['fn']) . ',';
                    if($editorName['mi']){
                        $html .= ' ' . uppercasefirstword($editorName['mi']) . 'editor. ';
                    }
                    $html .= 'editor. ';
                } else {
                    //The author name is a corporation not a person
                    $html .= ', ';
                }
            }
        }
    }
    return $html;
    
}

/********************************/
/*     Citation parsing         */
/********************************/

function CSLbookcite($data){
    //print_r($data);
    $key_order = array(     

            'Book Section'=> array(
                                            'title_of_article' =>10,
                                            'title1_of_parent'=>11,
                                            'editor'=>12,
                                            'pagination'=>13,
                                            'place_of_publication'=>14,
                                            'publisher'=>15,
                                            'vernacular_year'=>22,
                                            'gregorian_year'=>23,
                                            'reference_type'=>24,
                                            'author'        =>25,
                                            'artist'        =>26,
                                            'product'   =>27,
                                            'translated_title'=>28,
                                            'language'=>29,
                                            'other_person_mentioned'=>42,
                                            'archivist_remarks'=>43,
                                            'descriptive_tags'  =>44,
                                            'location'  =>45,
                                            'translator'=>46,
                                            'translated1_title_of_parent'=>47,
                                            'translated_byform'=>48,
                                            'doi_url'=>49,
                                            'illustrated'=>50,
                                            'curator'=>51,
                                            'compiler'=>52,
                                            'gallery_musuem'=>53,
                                            'place_of_gallery'=>54,
                                            'edition'   =>55,
                                            'foreword'=>56,
                                            'preface'=>57,
                                            'contributor'=>58,
                                            'volume'    =>59
                ), 
                'Book'=> array(
                                            
                                            'title1_of_parent'=>11,
                                            'editor'=>12,
                                            'pagination'=>13,
                                            'place_of_publication'=>14,
                                            'publisher'=>15,
                                            'vernacular_year'=>22,
                                            'gregorian_year'=>23,
                                            'reference_type'=>24,
                                            'author'        =>25,
                                            'artist'        =>26,
                                            'product'   =>27,
                                            'translated_title'=>28,
                                            'language'=>29,
                                            'other_person_mentioned'=>42,
                                            'archivist_remarks'=>43,
                                            'descriptive_tags'  =>44,
                                            'location'  =>45,
                                            'translator'=>46,
                                            'translated1_title_of_parent'=>47,
                                            'translated_byform'=>48,
                                            'doi_url'=>49,
                                            'illustrated'=>50,
                                            'curator'=>51,
                                            'compiler'=>52,
                                            'gallery_musuem'=>53,
                                            'place_of_gallery'=>54,
                                            'edition'   =>55,
                                            'foreword'=>56,
                                            'preface'=>57,
                                            'contributor'=>58,
                                            'volume'    =>59,
                                            'type1_of_parent'=>60,
                                            'subject'=>61,
                                            'book_cover_designer'=>62
                ), 
            'Journal Article'   => array(   
                                            
                                            'title_of_article' =>10,
                                            'title1_of_parent'=>11,
                                            'volume'=>13,
                                            'issue'=>14,
                                            'gregorian_month'=>27,
                                            'date'=>28,
                                            'gregorian_year'=>29,
                                            'vernacular_year'=>30,
                                            'pagination'=>31,
                                            'reference_type'=>32,
                                            'author'        =>33,
                                            'editor'   =>34,
                                            'artist'    =>35,
                                            'country_of_publication'=> 36,
                                            'place_of_publication'=>37,
                                            'product'=>38,
                                            'translated_title'=>39,
                                            'language'=> 40,
                                            'publisher'=>41,
                                            'other_person_mentioned'=>42,
                                            'archivist_remarks'=>43,
                                            'descriptive_tags'  =>44,
                                            'location'  =>45,
                                            'translator'=>46,
                                            'translated1_title_of_parent'=>47,
                                            'translated_byform'=>48,
                                            'doi_url'=>49,
                                            'illustrated'=>50,
                                            'curator'=>51,
                                            'compiler'=>52,
                                            'gallery_musuem'=>53,
                                            'place_of_gallery'=>54,
                                            'edition'   =>55,
                                            'foreword'=>56,
                                            'preface'=>57,
                                            'contributor'=>58,
                                            'editor'    =>59
                                            
                                    ),
            'Catalogue Essay'   => array(
                
                                            'Title of Article\/Essay' =>10,
                                            'Language'=>11,
                                            'Translated Title of Article\/Essay'=>12,
                                            'Title of the {{Product}}'=>13,
                                            'Translated Title of the {{Product}}'=>14,
                                            'Author\/s'=>17,
                                            'Reference Type'=>20,
                                            'Volume'=>25,
                                            'Exhibition' =>26,
                                            'Date'=>27,
                                            'Month'=>28,
                                            'Year'=>29,
                                            'Pagination'=>30,
                                            'Editor'=>31,
                                            'Curator'=>32,
                                            'Compiler'=>33,
                                            'Gallery/Musuem'=>34,
                                            'DOI \/ URL'=>35,
                                            'Publisher\/s'=>36,
                                            'Place Of Publication'=>37,
                                            'Country Of Publication'=>38,
                                            'Translated By\/From'=>39,
                                            'Artist\/s Mentioned'=>40,
                                            'Other Persons Mentioned'=>41,
                                            'Archivist Remarks'=>42,
                                            'Descriptive Tags'=>43,
                                            'Location'=>44,
                                            'category'    => 0,
                                            'pname'    => 1,
                                            'pid'    => 100
                                        ),
            'Catalogue' =>  array(
                                    'Title of the {{Product}}'=>10,
                                    'Language'=>11,
                                    'Translated Title of the {{Product}}'=>12,
                                    'Author\/s'=>13,
                                    'Editor'=>14,
                                    'Reference Type'=>15,
                                    'Volume'=>16,
                                    'Exhibition' =>17,
                                    'Date'=>18,
                                    'Month'=>19,
                                    'Year'=>20,
                                    'Pagination'=>21,
                                    'Curator'=>22,
                                    'Compiler'=>23,
                                    'Gallery/Musuem'=>24,
                                    'DOI \/ URL'=>25,
                                    'Publisher\/s'=>26,
                                    'Place Of Publication'=>27,
                                    'Country Of Publication'=>28,
                                    'Translated By\/From'=>29,
                                    'Artist\/s Mentioned'=>30,
                                    'Other Persons Mentioned'=>31,
                                    'Contributors in the {{product}}'=>32,
                                    'Foreword'  =>33,
                                    'Preface'   =>34,
                                    'Archivist Remarks'=>35,
                                    'Descriptive Tags'=>36,
                                    'Location'=>37,
                                    'category'    => 0,
                                    'pname'    => 1,
                                    'pid'    => 100        
                                    
                                    
                                    
                                    
                                    
                                    
                                    
            )
                                    
);
    $html = '';
    $flag = 0;
    if(array_key_exists('author', $data)) $html = csAuthorformat($data['author']);
    $category = $data['reference_type'];
    uksort($data, function($a, $b) use ($key_order, $category){
                    if($key_order[$category][$a] > $key_order[$category][$b]){
                    return 1;
                }elseif($key_order[$category][$a] < $key_order[$category][$b]){
                    return -1;
                }else{
                    return 0;
                }
            });
    //if(array_key_exists('Tranlator', $data)) $html = CSLtranlator ($data['Translator']);
    //if(array_key_exists('Editor', $data)) $html = CSLeditor ($data['Editor']);
    if($data['reference_type'] == 'Journal Article'){
         foreach ($data as $key => $val){
        
        switch ($key){
            
            case ($key == 'title_of_article'):
                $html .= ' "' .generateTags($data[$key]) . '." ';
                break;
            case ($key == 'title1_of_parent'):
                $html .= "<i>" .generateTags($data[$key]). "</i>" . " ";
                break;
            case ($key == 'volume'):
                $html .= " ".generateTags($data[$key]). ", ";
                break;
            case ($key == 'issue'):
                $html .= "no. " .generateTags($data[$key]). " ";
                break;
            case ($key == 'gregorian_month' || $key == 'date' || $key == 'gregorian_year'):
                
                if(!empty($data[$key]) && $key == 'gregorian_month'){
                    $html .= "(";
                    $flag++;
                    $html .= generateTags($data[$key]) . " ";
                    
                    
                }elseif(!empty($data[$key]) && $key == 'date'){
                        if(!$flag){$html .= "("; $flag++;}
                        $html .= generateTags($data[$key]) . ", ";
                    }elseif(!empty($data[$key]) && $key == 'gregorian_year'){
                        if(!$flag){$html .= "("; $flag++;}
                    $html .= generateTags($data[$key]) . ")";
                }
                        
                    
                
                
             
               
                break;
            case ($key == 'pagination'):
                $html .= ": " .generateTags($data[$key]) . ".";
                break;
            
        }
        
        
    }
    }elseif($data['reference_type'] == 'Book Section'){
        
         foreach ($data as $key => $val){
        
        switch ($key){
            
            case ($key == 'title_of_article'):
                $html .= ' "' .generateTags($data[$key]) . '." ';
                break;
            case ($key == 'title1_of_parent'):
                $html .= "In "."<i>" .generateTags($data[$key]). "</i>" . ", ";
                break;
            case ($key == 'editor'):
                $html .= "edited by " .generateTags($data[$key]).  ", ";
                break;
            case ($key == 'pagination'):
                $html .= generateTags($data[$key]) . ". ";
                break;
            case ($key == 'place_of_publication'):
                $html .= generateTags($data[$key]) . ": ";
                break;
            case ($key == 'publisher'):
                $html .= generateTags($data[$key]) . ", ";
                break;
            case ($key == 'vernacular_year'):
                //$html .= generateTags($data[$key]) . ".";
                if(!empty($data[$key])){
                    $html .= generateTags($data[$key]) . ".";
                    
                }
                break;
            case ($key == 'gregorian_year'):
                if(!empty($data['vernacular_year'])){
                $html .= "[" .generateTags($data[$key]) . "]";
                }else{
                    $html .= generateTags($data[$key]) . ".";
                }
                break;
            
        }
        
        
    }
        
    }elseif($data['reference_type'] == 'Catalogue Essay'){
        
        foreach ($data as $key => $val){
        
        switch ($key){
            
            case ($key == 'title_of_article'):
                $html .= ' "' .generateTags($data[$key]) . '". ';
                break;
            case ($key == 'title1_of_parent'):
                $html .= "In "."<i>" .generateTags($data[$key]). "</i>" . ", ";
                break;
            case ($key == 'editor'):
                $html .= "edited by " .generateTags($data[$key]).  ", ";
                break;
            case ($key == 'pagination'):
                $html .= generateTags($data[$key]) . ". ";
                break;
            case ($key == 'place_of_publication'):
                $html .= generateTags($data[$key]) . ": ";
                break;
            case ($key == 'publisher'):
                $html .= generateTags($data[$key]) . ", ";
                break;
            case ($key == 'gregorian_year'):
                $html .= generateTags($data[$key]) . ".";
                break;
            
        }
        
        
    }
        
    }elseif($data['reference_type'] == 'Book'){
        
            foreach ($data as $key => $val){
        
        switch ($key){
            
            case ($key == 'title1_of_parent'):
                $html .= "<i>" .generateTags($data[$key]). "</i>" . ". ";
                break;
            case ($key == 'editor'):
                $html .= "edited by " .generateTags($data[$key]).  ". ";
                break;
            case ($key == 'place_of_publication'):
                $html .= generateTags($data[$key]) . ": ";
                break;
            case ($key == 'publisher'):
                $html .= generateTags($data[$key]) . ", ";
                break;
            case ($key == 'gregorian_year'):
                $html .= generateTags($data[$key]) . ".";
                break;
            
        }
        
    }
    }
   
    
    
    return $html;
}



function generateTags($string = ''){
    if(!empty($string)){
       $result = trim($string);
    }
    return $result;
}