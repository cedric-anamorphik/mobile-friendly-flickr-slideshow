<?php
class SimpleFlickrPhotoApi {
    var $base_url = 'https://api.flickr.com/services/rest/';
    var $api_key;

    public function __construct() {
        $this->api_key = get_option('fshow_flickr_api_key');
    }

    public function get_user_id_from_username($username) {
        $args = array(  'method' => 'flickr.people.findByUsername',
                        'username' => $username );
        $result = $this->call($args);
        return $result->user->id;
    }

    public function get_photos( $photoset_id, $user_id = false ) {
        $args = array( 'method' => 'flickr.photosets.getPhotos',
                        'photoset_id' => $photoset_id );
        if ($user_id) {
            $args['user_id'] = $user_id;
        }
        $result = $this->call($args);
        return $result->photoset->photo;
    }

    private function call($args) {
        $args = array_merge($args, array( 'api_key' => $this->api_key,
                                          'format' => 'json',
                                          'nojsoncallback' => '1'));
        return $this->get_json($args);
    }

    private function get_json($args) {
        $url = $this->base_url . '?' . http_build_query($args);
        $result = $this->get($url);
        return json_decode($result['body']);
    }

    private function get($url,$params = array()) {
        global $wp_version;
        $params = array_merge($params,  array(
                                                'timeout'     => 5,
                                                'redirection' => 5,
                                                'httpversion' => '1.0',
                                                'user-agent'  => 'WordPress/' . $wp_version . '; ' . get_bloginfo( 'url' ),
                                                'blocking'    => true,
                                                'headers'     => array(),
                                                'cookies'     => array(),
                                                'body'        => null,
                                                'compress'    => false,
                                                'decompress'  => true,
                                                'sslverify'   => true,
                                                'stream'      => false,
                                                'filename'    => null
                                       ));
        $params = apply_filters('fshow_wp_remote_get_args',$params);
        return wp_remote_get( $url, $params );
    }
}
