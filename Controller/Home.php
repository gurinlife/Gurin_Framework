<?php

class Home extends Application
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $data['blogs'] = $m_blog->select('*', "is_deleted = '0' ORDER BY id DESC");
    get_view('blog', $data);
  }

  public function add()
  {
    $m_tag = new Database('tag');
    $tags  = $m_tag->select('*', "is_deleted = '0' ORDER BY name ASC");

    if ($_POST) {
      $m_blog = new Database('blog', false);

      $m_blog->validate('title', 'min_3');
      $m_blog->validate('title', 'max_100');
      $m_blog->validate('description', 'min_10');
      $m_blog->validate('description', 'max_10000');

      $m_blog->set_error_template('<i class="text-danger small">', '</i>');
      $errors = $m_blog->get_errors_with_template();

      if (!$m_blog->has_errors()) {
        $c_image = new Upload_Image($_FILES['image']);

        try {
          $data = array(
            'title'        => $_POST['title'],
            'description'  => $_POST['description'],
            'image'        => $c_image->get_image_name(),
            'date_created' => date('Y-m-d H:i:s')
          );

          $result = $m_blog->insert($data);

          if ($result) {
            $c_image->upload();
          }

          $m_blog->commit();
        } catch (Exception $e) {
          $c_image->unset_image();
          $m_blog->rollback();
        }
      }
    }

    get_view('add_blog', compact('m_blog', 'tags', 'errors'));
  }
}

