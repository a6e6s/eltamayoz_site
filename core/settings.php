<?php

/*
 * @Developed by : Ahmed Mosa .
 * @Developer Site: http//www.elmosamem.com 
 */

class Front_Settings extends model {

//  site settings 
    public $site_main_settings = [];
    public $Site_Name = ''; // site name.
    public $Main_Site_Status = 0; // main site closed  = 0 or open = 1 .
    public $Site_Status = 0; // site closed  = 0 or open = 1 .
    public $Logo = 'logo.png';
    public $mainSiteClosedMessage = '';
    public $SiteClosedMessage = '';
    public $SiteMetaDescription = '';
    public $SiteMetaKey = '';
    public $HeaderCode = '';
    public $FooterCode = '';
    public $defult_header_image = 'header_image.jpg';
    // main page settings
    //links title
    public $Site_Link_title_1 = '';
    public $Site_Link_title_2 = '';
    public $Site_Link_title_3 = '';
    public $Site_Link_title_4 = '';
    public $Site_Link_title_5 = '';
    public $Site_Link_title_6 = '';
    public $Site_Link_title_7 = '';
    public $Site_Link_title_8 = '';
    //links url
    public $Site_Link_url_1 = '';
    public $Site_Link_url_2 = '';
    public $Site_Link_url_3 = '';
    public $Site_Link_url_4 = '';
    public $Site_Link_url_5 = '';
    public $Site_Link_url_6 = '';
    public $Site_Link_url_7 = '';
    public $Site_Link_url_8 = '';
    //links url type
    public $Site_Link_type_1 = '';
    public $Site_Link_type_2 = '';
    public $Site_Link_type_3 = '';
    public $Site_Link_type_4 = '';
    public $Site_Link_type_5 = '';
    public $Site_Link_type_6 = '';
    public $Site_Link_type_7 = '';
    public $Site_Link_type_8 = '';
    //icons
    public $Site_Link_icon_1 = '';
    public $Site_Link_icon_2 = '';
    public $Site_Link_icon_3 = '';
    public $Site_Link_icon_4 = '';
    public $Site_Link_icon_5 = '';
    public $Site_Link_icon_6 = '';
    public $Site_Link_icon_7 = '';
    public $Site_Link_icon_8 = '';
//    site home settings
    public $slideshow_status = false;
    public $work_steps_status = false;
    public $services_status = false;
    public $works_status = false;
    public $blog_status = false;
    public $clients_status = false;
    public $works_number = 0;
    public $blog_number = 0;
    public $services_image = '';
    public $site_home_settings = [];
//  mail settings
    public $email_from_name = '';
    public $email_from_address = '';
    public $SMTP_auth = 0;
    public $SMTP_secure = 'none';
    public $SMTP_port = '';
    public $SMTP_server = '';
    public $SMTP_username = '';
    public $SMTP_password = '';
    // contact settings
    public $page_contacts_title = '';
    public $info_contacts_title = '';
    public $address_contacts_title = '';
    public $work_contacts = '';
    public $holiday_contacts = '';
    public $email = '';
    public $phone = '';
    public $mobile = '';
    public $maplat = 0;
    public $maplng = 0;
    public $zoom = 10;
    // requests settings
    public $page_requests_title = '';
    public $info_requests_title = '';
    public $address_requests_title = '';
    public $work_requests = '';
    public $holiday_requests = '';
    public $services_requests = '';
    public $requests_email = '';
    public $requests_phone = '';
    public $requests_mobile = '';
    public $requests_header_image = '';
    public $requests_header_image_opacity = '';
    // social settings
    public $facebook = '';
    public $twitter = '';
    public $youtube = '';
    public $google = '';
    public $linkedin = '';
    // blog settings
    public $header_image = '';
    public $header_image_opacity = '';
    public $per_page = 0;
    public $blog_desc = '';
    public $blog_keys = '';

    public function global_settings() {
        $site_settings_array = $this->select('name,alias,status,message_closed,logo,meta_desc,meta_key,message_closed,H_code,F_code', 'sites', " WHERE id = '1' ", null, null, 0, 1);
        if (is_array($site_settings_array)) {
            $site_name_array = isset($site_settings_array[0]['name']) ? unserialize(base64_decode($site_settings_array[0]['name'])) : '';
            $this->Site_Name = isset($site_name_array['site_name_' . $_SESSION['language_alias']]) ? $site_name_array['site_name_' . $_SESSION['language_alias']] : '';
            $this->Main_Site_Status = isset($site_settings_array[0]['status']) ? $site_settings_array[0]['status'] : 0;
            $logo_array = isset($site_settings_array[0]['logo']) ? unserialize(base64_decode($site_settings_array[0]['logo'])) : '';
            $desc_array = isset($site_settings_array[0]['meta_desc']) ? unserialize(base64_decode($site_settings_array[0]['meta_desc'])) : '';
            $keys_array = isset($site_settings_array[0]['meta_key']) ? unserialize(base64_decode($site_settings_array[0]['meta_key'])) : '';
            $message_closed = isset($site_settings_array[0]['message_closed']) ? unserialize(base64_decode($site_settings_array[0]['message_closed'])) : '';
            $this->Logo = isset($logo_array['site_logo_' . $_SESSION['language_alias']]) ? $logo_array['site_logo_' . $_SESSION['language_alias']] : 'logo.png';
            $this->SiteMetaDescription = isset($desc_array['site_desc_' . $_SESSION['language_alias']]) ? $desc_array['site_desc_' . $_SESSION['language_alias']] : '';
            $this->SiteMetaKey = isset($keys_array['site_keys_' . $_SESSION['language_alias']]) ? $keys_array['site_keys_' . $_SESSION['language_alias']] : '';
            $this->mainSiteClosedMessage = isset($message_closed['message_closed_' . $_SESSION['language_alias']]) ? $message_closed['message_closed_' . $_SESSION['language_alias']] : '';
            $this->HeaderCode = isset($site_settings_array[0]['H_code']) ? unserialize(base64_decode($site_settings_array[0]['H_code'])) : '';
            $this->FooterCode = isset($site_settings_array[0]['F_code']) ? unserialize(base64_decode($site_settings_array[0]['F_code'])) : '';
            
        }
    }

    public function main_site_links() {
        $site_settings_array = $this->select('settings_values', 'sites', " WHERE id = '1' ", null, null, 0, 1);
        if (is_array($site_settings_array)) {
            $this->site_main_settings = isset($site_settings_array[0]['settings_values']) ? unserialize(base64_decode($site_settings_array[0]['settings_values'])) : array();
            // links ..............
            $this->Site_Link_title_1 = isset($this->site_main_settings['link_1_title_' . $_SESSION['language_alias']]) ? $this->site_main_settings['link_1_title_' . $_SESSION['language_alias']] : '';
            $this->Site_Link_title_2 = isset($this->site_main_settings['link_2_title_' . $_SESSION['language_alias']]) ? $this->site_main_settings['link_2_title_' . $_SESSION['language_alias']] : '';
            $this->Site_Link_title_3 = isset($this->site_main_settings['link_3_title_' . $_SESSION['language_alias']]) ? $this->site_main_settings['link_3_title_' . $_SESSION['language_alias']] : '';
            $this->Site_Link_title_4 = isset($this->site_main_settings['link_4_title_' . $_SESSION['language_alias']]) ? $this->site_main_settings['link_4_title_' . $_SESSION['language_alias']] : '';
            $this->Site_Link_title_5 = isset($this->site_main_settings['link_5_title_' . $_SESSION['language_alias']]) ? $this->site_main_settings['link_5_title_' . $_SESSION['language_alias']] : '';
            $this->Site_Link_title_6 = isset($this->site_main_settings['link_6_title_' . $_SESSION['language_alias']]) ? $this->site_main_settings['link_6_title_' . $_SESSION['language_alias']] : '';
            $this->Site_Link_title_7 = isset($this->site_main_settings['link_7_title_' . $_SESSION['language_alias']]) ? $this->site_main_settings['link_7_title_' . $_SESSION['language_alias']] : '';
            $this->Site_Link_title_8 = isset($this->site_main_settings['link_8_title_' . $_SESSION['language_alias']]) ? $this->site_main_settings['link_8_title_' . $_SESSION['language_alias']] : '';
            $this->Site_Link_url_1 = isset($this->site_main_settings['link_1_url']) ? $this->site_main_settings['link_1_url'] : '';
            $this->Site_Link_url_2 = isset($this->site_main_settings['link_2_url']) ? $this->site_main_settings['link_2_url'] : '';
            $this->Site_Link_url_3 = isset($this->site_main_settings['link_3_url']) ? $this->site_main_settings['link_3_url'] : '';
            $this->Site_Link_url_4 = isset($this->site_main_settings['link_4_url']) ? $this->site_main_settings['link_4_url'] : '';
            $this->Site_Link_url_5 = isset($this->site_main_settings['link_5_url']) ? $this->site_main_settings['link_5_url'] : '';
            $this->Site_Link_url_6 = isset($this->site_main_settings['link_6_url']) ? $this->site_main_settings['link_6_url'] : '';
            $this->Site_Link_url_7 = isset($this->site_main_settings['link_7_url']) ? $this->site_main_settings['link_7_url'] : '';
            $this->Site_Link_url_8 = isset($this->site_main_settings['link_8_url']) ? $this->site_main_settings['link_8_url'] : '';
            $this->Site_Link_type_1 = isset($this->site_main_settings['link_1_type']) ? $this->site_main_settings['link_1_type'] : 'internal';
            $this->Site_Link_type_3 = isset($this->site_main_settings['link_2_type']) ? $this->site_main_settings['link_2_type'] : 'internal';
            $this->Site_Link_type_3 = isset($this->site_main_settings['link_3_type']) ? $this->site_main_settings['link_3_type'] : 'internal';
            $this->Site_Link_type_4 = isset($this->site_main_settings['link_4_type']) ? $this->site_main_settings['link_4_type'] : 'internal';
            $this->Site_Link_type_5 = isset($this->site_main_settings['link_5_type']) ? $this->site_main_settings['link_5_type'] : 'internal';
            $this->Site_Link_type_6 = isset($this->site_main_settings['link_6_type']) ? $this->site_main_settings['link_6_type'] : 'internal';
            $this->Site_Link_type_7 = isset($this->site_main_settings['link_7_type']) ? $this->site_main_settings['link_7_type'] : 'internal';
            $this->Site_Link_type_8 = isset($this->site_main_settings['link_8_type']) ? $this->site_main_settings['link_8_type'] : 'internal';
            $this->Site_Link_icon_1 = isset($this->site_main_settings['icon_1']) ? $this->site_main_settings['icon_1'] : '';
            $this->Site_Link_icon_2 = isset($this->site_main_settings['icon_2']) ? $this->site_main_settings['icon_2'] : '';
            $this->Site_Link_icon_3 = isset($this->site_main_settings['icon_3']) ? $this->site_main_settings['icon_3'] : '';
            $this->Site_Link_icon_4 = isset($this->site_main_settings['icon_4']) ? $this->site_main_settings['icon_4'] : '';
            $this->Site_Link_icon_5 = isset($this->site_main_settings['icon_5']) ? $this->site_main_settings['icon_5'] : '';
            $this->Site_Link_icon_6 = isset($this->site_main_settings['icon_6']) ? $this->site_main_settings['icon_6'] : '';
            $this->Site_Link_icon_7 = isset($this->site_main_settings['icon_7']) ? $this->site_main_settings['icon_7'] : '';
            $this->Site_Link_icon_8 = isset($this->site_main_settings['icon_8']) ? $this->site_main_settings['icon_8'] : '';
        }
    }

    public function site_settings($site_id) {
        $site_settings_array = $this->select('name,alias,status,message_closed,logo,meta_desc,meta_key,message_closed,H_code,F_code', 'sites', " WHERE id = '" . $site_id . "' ", null, null, 0, 1);
        if (is_array($site_settings_array)) {
            $site_name_array = isset($site_settings_array[0]['name']) ? unserialize(base64_decode($site_settings_array[0]['name'])) : '';
            $logo_array = isset($site_settings_array[0]['logo']) ? unserialize(base64_decode($site_settings_array[0]['logo'])) : '';
            $desc_array = isset($site_settings_array[0]['meta_desc']) ? unserialize(base64_decode($site_settings_array[0]['meta_desc'])) : '';
            $keys_array = isset($site_settings_array[0]['meta_key']) ? unserialize(base64_decode($site_settings_array[0]['meta_key'])) : '';
            $message_closed = isset($site_settings_array[0]['message_closed']) ? unserialize(base64_decode($site_settings_array[0]['message_closed'])) : '';
            $this->Site_Name = isset($site_name_array['site_name_' . $_SESSION['language_alias']]) ? $site_name_array['site_name_' . $_SESSION['language_alias']] : '';
            $this->Site_Status = isset($site_settings_array[0]['status']) ? $site_settings_array[0]['status'] : 1;
            $this->Logo = isset($logo_array['site_logo_' . $_SESSION['language_alias']]) ? $logo_array['site_logo_' . $_SESSION['language_alias']] : 'logo.png';
            $this->SiteMetaDescription = isset($desc_array['site_desc_' . $_SESSION['language_alias']]) ? $desc_array['site_desc_' . $_SESSION['language_alias']] : '';
            $this->SiteMetaKey = isset($keys_array['site_keys_' . $_SESSION['language_alias']]) ? $keys_array['site_keys_' . $_SESSION['language_alias']] : '';
            $this->SiteClosedMessage = isset($message_closed['message_closed_' . $_SESSION['language_alias']]) ? $message_closed['message_closed_' . $_SESSION['language_alias']] : '';
            $this->HeaderCode = isset($site_settings_array[0]['H_code']) ? unserialize(base64_decode($site_settings_array[0]['H_code'])) : '';
            $this->FooterCode = isset($site_settings_array[0]['F_code']) ? unserialize(base64_decode($site_settings_array[0]['F_code'])) : '';
        }
    }
    // sss

    public function site_home_settings($site_id) {
        $site_settings_array = $this->select('settings_values', 'sites', " WHERE id = '" . $site_id . "' ", null, null, 0, 1);
        if (is_array($site_settings_array)) {
            $this->site_home_settings = isset($site_settings_array[0]['settings_values']) ? unserialize(base64_decode($site_settings_array[0]['settings_values'])) : array();
            $this->slideshow_status = (isset($this->site_home_settings['slideshow_status']) && $this->site_home_settings['slideshow_status'] == 1) ? true : false;
            $this->work_steps_status = (isset($this->site_home_settings['work_steps_status']) && $this->site_home_settings['work_steps_status'] == 1) ? true : false;
            $this->services_status = (isset($this->site_home_settings['services_status']) && $this->site_home_settings['services_status'] == 1) ? true : false;
            $this->works_status = (isset($this->site_home_settings['works_status']) && $this->site_home_settings['works_status'] == 1) ? true : false;
            $this->blog_status = (isset($this->site_home_settings['blog_status']) && $this->site_home_settings['blog_status'] == 1) ? true : false;
            $this->clients_status = (isset($this->site_home_settings['clients_status']) && $this->site_home_settings['clients_status'] == 1) ? true : false;
            $this->works_number = (isset($this->site_home_settings['works_number'])) ? $this->site_home_settings['works_number'] : 0;
            $this->blog_number = (isset($this->site_home_settings['blog_number'])) ? $this->site_home_settings['blog_number'] : 0;
            $this->services_image = (isset($this->site_home_settings['services_image'])) ? $this->site_home_settings['services_image'] : '';
        }
    }

    public function mail_settings() {
        $mail_settings_array = $this->select('*', 'settings', " WHERE id = '2' ", null, null, 0, 1);
        if (is_array($mail_settings_array)) {
            $_settings_values = isset($mail_settings_array[0]['settings_values']) ? unserialize(base64_decode($mail_settings_array[0]['settings_values'])) : array();
            $this->email_from_name = isset($_settings_values['email_from_name']) ? $_settings_values['email_from_name'] : '';
            $this->email_from_address = isset($_settings_values['email_from_address']) ? $_settings_values['email_from_address'] : '';
            $this->SMTP_auth = isset($_settings_values['auth']) ? $_settings_values['auth'] : 0;
            $this->SMTP_secure = isset($_settings_values['secure']) ? $_settings_values['secure'] : '';
            $this->SMTP_port = isset($_settings_values['port']) ? $_settings_values['port'] : '0';
            $this->SMTP_server = isset($_settings_values['server']) ? $_settings_values['server'] : '';
            $this->SMTP_username = isset($_settings_values['username']) ? $_settings_values['username'] : '';
            $this->SMTP_password = isset($_settings_values['password']) ? $_settings_values['password'] : '';
        }
    }

    public function contact_settings() {
        $contact_settings_array = $this->select('*', 'settings', " WHERE id = '6' ", null, null, 0, 1);
        if (is_array($contact_settings_array)) {
            $_settings_values = isset($contact_settings_array[0]['settings_values']) ? unserialize(base64_decode($contact_settings_array[0]['settings_values'])) : [];
            $this->page_contacts_title = isset($_settings_values['page_title_' . $_SESSION['language_alias']]) ? $_settings_values['page_title_' . $_SESSION['language_alias']] : '';
            $this->info_contacts_title = isset($_settings_values['info_title_' . $_SESSION['language_alias']]) ? $_settings_values['info_title_' . $_SESSION['language_alias']] : '';
            $this->address_contacts_title = isset($_settings_values['address_' . $_SESSION['language_alias']]) ? $_settings_values['address_' . $_SESSION['language_alias']] : '';
            $this->work_contacts = isset($_settings_values['work_' . $_SESSION['language_alias']]) ? $_settings_values['work_' . $_SESSION['language_alias']] : '';
            $this->holiday_contacts = isset($_settings_values['holiday_' . $_SESSION['language_alias']]) ? $_settings_values['holiday_' . $_SESSION['language_alias']] : '';
            $this->email = (isset($_settings_values['email'])) ? $_settings_values['email'] : '';
            $this->phone = (isset($_settings_values['phone'])) ? $_settings_values['phone'] : '';
            $this->mobile = (isset($_settings_values['mobile'])) ? $_settings_values['mobile'] : '';
            $this->maplat = (isset($_settings_values['maplat'])) ? $_settings_values['maplat'] : 0;
            $this->maplng = (isset($_settings_values['maplng'])) ? $_settings_values['maplng'] : 0;
            $this->zoom = (isset($_settings_values['zoom'])) ? $_settings_values['zoom'] : 10;
        }
    }

    public function requests_settings() {
        $requests_settings_array = $this->select('*', 'settings', " WHERE settings_name = 'requests settings' ", null, null, 0, 1);
        if (is_array($requests_settings_array)) {
            $_settings_values = isset($requests_settings_array[0]['settings_values']) ? unserialize(base64_decode($requests_settings_array[0]['settings_values'])) : [];
            $this->page_requests_title = isset($_settings_values['page_title_' . $_SESSION['language_alias']]) ? $_settings_values['page_title_' . $_SESSION['language_alias']] : '';
            $this->info_requests_title = isset($_settings_values['info_title_' . $_SESSION['language_alias']]) ? $_settings_values['info_title_' . $_SESSION['language_alias']] : '';
            $this->address_requests_title = isset($_settings_values['address_' . $_SESSION['language_alias']]) ? $_settings_values['address_' . $_SESSION['language_alias']] : '';
            $this->work_requests = isset($_settings_values['work_' . $_SESSION['language_alias']]) ? $_settings_values['work_' . $_SESSION['language_alias']] : '';
            $this->holiday_requests = isset($_settings_values['holiday_' . $_SESSION['language_alias']]) ? $_settings_values['holiday_' . $_SESSION['language_alias']] : '';
            $this->services_requests = isset($_settings_values['services_' . $_SESSION['language_alias']]) ? $_settings_values['services_' . $_SESSION['language_alias']] : '';
            $this->requests_email = (isset($_settings_values['email'])) ? $_settings_values['email'] : '';
            $this->requests_phone = (isset($_settings_values['phone'])) ? $_settings_values['phone'] : '';
            $this->requests_mobile = (isset($_settings_values['mobile'])) ? $_settings_values['mobile'] : '';
            $this->requests_header_image = isset($_settings_values['header_image']) ? $_settings_values['header_image'] : '';
            $this->requests_header_image_opacity = isset($_settings_values['header_image_opacity']) ? $_settings_values['header_image_opacity'] : 1;
        }
    }

    public function social_settings() {
        $social_settings_array = $this->select('*', 'settings', " WHERE id = '7' ", null, null, 0, 1);
        if (is_array($social_settings_array)) {
            $_settings_values = isset($social_settings_array[0]['settings_values']) ? unserialize(base64_decode($social_settings_array[0]['settings_values'])) : [];
            $this->facebook = isset($_settings_values['facebook']) ? $_settings_values['facebook'] : '';
            $this->twitter = isset($_settings_values['twitter']) ? $_settings_values['twitter'] : '';
            $this->youtube = isset($_settings_values['youtube']) ? $_settings_values['youtube'] : '';
            $this->google = isset($_settings_values['google']) ? $_settings_values['google'] : '';
            $this->linkedin = isset($_settings_values['linkedin']) ? $_settings_values['linkedin'] : '';
        }
    }

    public function blog_settings() {
        $blog_settings_array = $this->select('*', 'settings', " WHERE id = '8' ", null, null, 0, 1);
        if (is_array($blog_settings_array)) {
            $_settings_values = isset($blog_settings_array[0]['settings_values']) ? unserialize(base64_decode($blog_settings_array[0]['settings_values'])) : [];
            $this->header_image = isset($_settings_values['header_image']) ? $_settings_values['header_image'] : '';
            $this->header_image_opacity = isset($_settings_values['header_image_opacity']) ? $_settings_values['header_image_opacity'] : 1;
            $this->per_page = isset($_settings_values['per_page']) ? $_settings_values['per_page'] : '';
            $this->blog_desc = isset($_settings_values['meta_desc_' . $_SESSION['language_alias']]) ? $_settings_values['meta_desc_' . $_SESSION['language_alias']] : '';
            $this->blog_keys = isset($_settings_values['meta_keys_' . $_SESSION['language_alias']]) ? $_settings_values['meta_keys_' . $_SESSION['language_alias']] : '';
        }
    }

}
