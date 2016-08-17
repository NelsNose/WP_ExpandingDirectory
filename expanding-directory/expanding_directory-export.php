<?php 

class expanding_directory_export{

  private $separator;

  function __construct($category = null, $sep = ';', $filename = null){
    $this->separator = $sep;

    if (null == $filename) {
      $filename = strtolower(get_blog_info())."-directory_items";
      $filename = preg_replace('/\s/', '_', $filename);
    }

    $generatedDate = date('d-m-Y_His');

    $csvFile = $this->generate_csv($category);
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private", false);
    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=\"" . $filename . "-" . $generatedDate . ".csv\";" );
    header("Content-Transfer-Encoding: binary");

    echo $csvFile;
    exit;
  }

  function generate_csv($category = null){
    $dirArgs = array();
    $dirArgs['post_type'] = 'directory_item';

    if (!is_null($category) && $category != 'all') {
      if (is_numeric($category)) {
        $dirArgs['tag_id'] = $category;
      }
      else {
        $dirArgs['tag'] = $category;
      }
    }

    $dirArgs['posts_per_page'] = '-1';
    $dirArgs['orderby'] = 'title';
    $dirArgs['order'] = 'ASC';

    $dirQuery = new wp_Query($dirArgs);

    $sep = $this->separator;
    $output = 'ID'.$sep.'Business Name'.$sep.'Website'.$sep.'Phone'.$sep.'Mobile'.$sep.'Fax'.$sep.'Email'.$sep.'Street'.$sep.'City'.$sep.'State'.$sep.'Zip'.$sep.'Tags'."\r\n";

    if ($dirQuery->have_posts()) :
      while ($dirQuery->have_posts()) : $dirQuery->the_post();
        $postid = get_the_ID();
        $posttitle = preg_replace('/^\*/', '1 ', get_the_title());
        $didetails = get_post_meta($postid);
        $tags = wp_get_post_tags($postid);

        $url = (isset($didetails['dir_website'])) ? $didetails['dir_website'][0] : '';
        if (!preg_match('/^http/', $url)) {
          $url = 'http://'.$url; 
        }

        $phone = (isset($didetails['dir_phone'][0])) ? $didetails['dir_phone'][0] : '';
        $mobile = (isset($didetails['dir_mobile'][0])) ? $didetails['dir_mobile'][0] : '';
        $fax = (isset($didetails['dir_fax'][0])) ? $didetails['dir_fax'][0] : '';
        $email = (isset($didetails['dir_email'][0])) ? $didetails['dir_email'][0] : '';
        $address = (isset($didetails['dir_address'][0])) ? $didetails['dir_address'][0] : '';
        $city = (isset($didetails['dir_city'][0])) ? $didetails['dir_city'][0] : '';
        $state = (isset($didetails['dir_state'][0])) ? $didetails['dir_state'][0] : '';
        $zip = (isset($didetails['dir_zip'][0])) ? $didetails['dir_zip'][0] : '';

        $export_tags = '';
        foreach ($tags as $tag) {
          $export_tags .= $tag->name . ', ';
        }
        $export_tags = rtrim(',', rtrim($export_tags));

        $output .= $postid . $sep . 
          '"' . get_the_title() . '"' . $sep .
          '"' . $url . '"' . $sep .
          '"' . $phone . '"' . $sep .
          '"' . $mobile . '"' . $sep .
          '"' . $fax . '"' . $sep .
          '"' . $email . '"' . $sep .
          '"' . $address . '"' . $sep .
          '"' . $city . '"' . $sep .
          '"' . $state . '"' . $sep .
          '"' . $zip . '"' . $sep .
          '"' . $export_tags . '"' . "\r\n";

      endwhile;
    endif;
    wp_reset_postdata();
    return $output;
  }
}

add_action('init', 'export_directory_items');
function export_directory_items() {
  if(isset($_POST['directory_download']) && $_POST['directory_download'] == 'download'){
    $exportCSV = new expanding_directory_export($_POST['directory_category'], $_POST['directory_seperator'], $_POST['directory_filename']);                //Make your changes on these lines
  }
}