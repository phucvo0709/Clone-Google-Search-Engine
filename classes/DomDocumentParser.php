<?php
class DomDocumentParser {
    private $doc;
    public function __construct($url){
        $options = array(
                'http'=>array(
                    'method'=>"GET",
                    'header'=>"User-agent: poopleBot/0.1\n"
                )
        );
        $context = stream_context_create($options); //Creates a stream context;
        $this->doc = new DOMDocument();
        @$this->doc->loadHTML(file_get_contents($url, false, $context));//get content html
    }
    public function getLinks(){
        return $this->doc->getElementsByTagName("a");//get only tag a in content html
    }
    public function getTitleTags(){
        return $this->doc->getElementsByTagName("title");//get only tag a in content html
    }
    public function getMetaTags(){
        return $this->doc->getElementsByTagName("meta");//get only tag a in content html
    }
    public function getImages(){
        return $this->doc->getElementsByTagName("img");//get only tag a in content html
    }
}