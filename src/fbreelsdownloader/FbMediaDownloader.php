<?php 
namespace FbMediaDownloader;
class Downloader
{
    // $result holds the result of the media download
    protected $result ="";
    // headers http
    protected $headers = [];

    // $status holds the HTTP status code of the download operation
    protected $status;
    // user agent
    protected $user_agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36';

    // $is_proxy indicates whether a proxy is being used for the download
    protected $is_proxy = false;

    // $proxy holds the proxy settings if a proxy is being used
    protected $proxy =  "";
    //video id
    protected $id = '';
    // video url
    protected $url = '';

    //model data
    protected $title = '';
    protected $dl_urls = [];

    
    // The constructor initializes the $result as an empty array and $status as 200
    function __construct(){
        $this->result = "";
        $this->headers = [
            'sec-fetch-user: ?1',
            'sec-ch-ua-mobile: ?0',
            'sec-fetch-site: none',
            'sec-fetch-dest: document',
            'sec-fetch-mode: navigate',
            'cache-control: max-age=0',
            'authority: www.facebook.com',
            'upgrade-insecure-requests: 1',
            'accept-language: en-GB,en;q=0.9,tr-TR;q=0.8,tr;q=0.7,en-US;q=0.6',
            'sec-ch-ua: "Google Chrome";v="89", "Chromium";v="89", ";Not A Brand";v="99"',
            // 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36',
            'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9'
        
        ];
        $this->status = 200;
    }
    public function withProxy(): self{
        $this->is_proxy = true;
        return $this;
    }
    public function setProxy($proxy): self{
        
        $this->is_proxy = true;
        $this->proxy = $proxy;
        return $this;
    }
    public function set_user_agent($user_agent): self{
        $this->user_agent = $user_agent;
        return $this;
    }
    //set url
    public function set_url($url): self{
        // check its url or not
        if(!filter_var($url, FILTER_VALIDATE_URL)){
            throw new \Exception("Invalid URL");
        }
        // check its fb url or not
        if(!preg_match('/facebook.com/', $url)){
            throw new \Exception("Invalid URL");
        }
        //extract id from url
        $this->extract_id($url);
        //check is there is id
        if(empty($this->get_id())){
            throw new \Exception("Invalid URL");
        }
        //set url
        $this->url = $url;
        
        return $this;
    }
    //get url
    public function get_url(): string{
        return $this->url;
    }
    // set header
    public function set_header($header): self{
        $this->headers = $header;
        return $this;
    }
    // get header
    public function get_header(): array{
        return $this->headers;
    }

    //set id 
    public function set_id($id): self{
        $this->id = $id;
        return $this;
    }
    //get id
    public function get_id(): string{
        return $this->id;
    }
    //get title
    public function get_title(): string{
        return $this->title;
    }
    //get download urls
    public function get_dl_urls(): array{
        return $this->dl_urls;
    }
    //set title
    public function set_title($title): self{
        $this->title = $title;
        return $this;
    }
    //set download urls
    public function set_dl_urls($dl_urls): self{
        $this->dl_urls = $dl_urls;
        return $this;
    }
    // get all infor
    public function get_datas(): array{
        return [
            'title' => $this->get_title(),
            'dl_urls' => $this->get_dl_urls(),
            'status' => $this->get_status(),
            'id'    => $this->get_id(),
            'url'   => $this->get_url()
            
        ];
    }
    public function get_status(){
        return $this->status;
    }  
    public function get_result(): string {
        return $this->result;
    }
    
    //extract id from url
    public function extract_id($url='') : string {
        if(empty($url)){
            $url = $this->get_url();
        }
        $id = '';
        if (is_int($url)) {
            $id = $url;
        } elseif (preg_match('#(\d+)/?$#', $url, $matches)) {
            $id = $matches[1];
        }
        $this->set_id($id);
        return $id;
    }
    //clean string
    public function clean_str($str): string {
        $tmpStr = "{\"text\": \"{$str}\"}";
        return json_decode($tmpStr)->text;
    }
    //get sd link
    public function get_sd_link($content = ''): string {
        if(empty($content)){
            $content = $this->get_response();
        }
        $regexRateLimit = '/browser_native_sd_url":"([^"]+)"/';
        if (preg_match($regexRateLimit, $content, $match)) {
            return $this->clean_str($match[1]) . '&dl=1';
        } else {
            return "";
        }
    }
    //get hd link
    public function get_hd_link($content = ''): string {
        if(empty($content)){
            $content = $this->get_response();
        }
        $regexRateLimit = '/browser_native_hd_url":"([^"]+)"/';
        if (preg_match($regexRateLimit, $content, $match)) {
            return $this->clean_str($match[1]) . '&dl=1';
        } else {
            return "";
        }
    }
    //extract title
    public function extract_title($content = ''): string {
        if(empty($content)){
            $content = $this->get_response();
        }
        if (preg_match('/property="og:title" content="(.*?)"/', $content, $matches)) {
           if(!empty($matches[1])) return html_entity_decode($this->clean_str($matches[1]));
            
        } 
        if (preg_match('/<title>(.+?)<\/title>/', $content, $matches)) {
            if(!empty($matches[1]))   return html_entity_decode($this->clean_str($matches[1]));
        } 
        return "";
    }

    

    public function fetch_by_id($id= ''): self {  
        if(empty($id)){
            $id = $this->get_id();
        }
        $url = "https://www.facebook.com/reel/".$id;
        $data =  $this->request($url, $this->get_header());
        if($data['status'] == 200){
           $this->result = $data['result'];
           
        }else{
            $this->status = $data['status'];
            $this->result = $data['result'];
        }
        return $this;
    }
    // fetch data from url
    public function fetch_by_url(): self{

        $url = $this->get_url();
        $data =  $this->request($url, $this->get_header());
        if($data['status'] == 200){
           $this->result = $data['result'];
           
        }else{
            $this->status = $data['status'];
            $this->result = $data['result'];
        }
        return $this;
    }


    
    //fetch 
    public function fetch( ): self {  
        // if url have
        if(!empty($this->get_url())){
            return $this->fetch_by_url();
        }
        // if id have
        if(!empty($this->get_id())){
            return $this->fetch_by_id();
        }
        return $this;
    }

    // get response 
    public function get_response(): string {
        // if result have
        if(!empty($this->get_result())){
            return $this->get_result();
        }
        $this->fetch();

        return $this->result;
    }

    
  
    // profile data
    public function get_by_url($url=''){  
        if(empty($url)){
            $url = $this->get_url();
        }
        $data =  $this->request($url);
        if($data['status'] == 200){
           $this->result = $data['result'];
           
        }else{
            $this->status = $data['status'];
            $this->result = $data['result'];
        }
        return $this;
    }
    // get download links
    public function generate_data($content = ''): array {
        if(empty($content)){
            $content = $this->get_response();
        }
        if(empty($content)){
            throw new \Exception("No data found");
        }
        $title = $this->extract_title();
        $sdLink = $this->get_sd_link();
        $hdLink = $this->get_hd_link();
        $this->set_title($title);
        $this->set_dl_urls([
            'low' => $sdLink,
            'high' => $hdLink
        ]);
        return $this->get_datas();
    }
    
    public function request($url, $header=[]): array {
        $ch = curl_init();
        if(!empty($header) && is_array($header)){ 
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        //usern agent 
        curl_setopt($ch, CURLOPT_USERAGENT,  $this->user_agent );
        
        curl_setopt($ch, CURLOPT_HEADER, 1);
    
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        if($this->is_proxy){ 
            curl_setopt($ch, CURLOPT_PROXY,  $this->proxy);
        }
        $headers = array();
        $result = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (curl_errno($ch)) {
            return ['status'=> $httpcode, 'result' => curl_error($ch)];
        }
        // Then, after your curl_exec call:
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $content_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
        curl_close($ch);
        $header = substr($result, 0, $header_size);
        $result = substr($result, $header_size);
        return ['status'=> $httpcode, 'result' => $result];
    }
}