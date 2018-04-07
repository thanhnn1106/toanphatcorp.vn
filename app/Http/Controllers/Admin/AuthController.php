<?php


namespace App\Http\Controllers\Admin;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class AuthController extends Controller
{
    use AuthenticatesUsers;

    /**
     * @var App|Application
     */
    protected $app;
    protected $mailer;

    // Overwrite
    protected $redirectAfterLogout = '/cpanel/login';
    protected $redirectPath        = '/cpanel';

    /**
     * AuthController constructor.
     * @param Application $app
     * @param Mailer $mailer
     */
    public function __construct(Application $app, Mailer $mailer)
    {
        $this->app    = $app;
        $this->mailer = $mailer;

        $this->middleware('guest:admin', [
            'except' => [
                'logout',
                'activatedPage'
            ],
        ]);
    }
    
    public $arr = array(
                'tag1' => array(
                    'total' => 1,
                    'returned' => 1,
                    'entry' => array(
                        array(
                            'article_id' => 1,
                            'name' => 'Article 1'
                        ),
//                        array(
//                            'article_id' => 2,
//                            'name' => 'Article 2'
//                        ),
//                        array(
//                            'article_id' => 3,
//                            'name' => 'Article 3'
//                        ),
//                        array(
//                            'article_id' => 4,
//                            'name' => 'Article 4'
//                        ),
//                        array(
//                            'article_id' => 5,
//                            'name' => 'Article 5'
//                        ),
                    ),
                ),
                'tag2' => array(
                    'total' => 1,
                    'returned' => 1,
                    'entry' => array(
                        array(
                            'article_id' => 6,
                            'name' => 'Article 6'
                        ),
//                        array(
//                            'article_id' => 7,
//                            'name' => 'Article 7'
//                        ),
//                        array(
//                            'article_id' => 8,
//                            'name' => 'Article 8'
//                        ),
//                        array(
//                            'article_id' => 9,
//                            'name' => 'Article 9'
//                        ),
//                        array(
//                            'article_id' => 10,
//                            'name' => 'Article 10'
//                        ),
                    ),
                ),
                'tag3' => array(
                    'total' => 3,
                    'returned' => 3,
                    'entry' => array(
                        array(
                            'article_id' => 11,
                            'name' => 'Article 11'
                        ),
                        array(
                            'article_id' => 12,
                            'name' => 'Article 12'
                        ),
                        array(
                            'article_id' => 13,
                            'name' => 'Article 13'
                        ),
//                        array(
//                            'article_id' => 14,
//                            'name' => 'Article 14'
//                        ),
//                        array(
//                            'article_id' => 15,
//                            'name' => 'Article 15'
//                        ),
                    ),
                ),
            );
    /**
     * Overwrite
     * 
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    { 
      
      //$this->test_data($this->arr);
      $articles = array();
      $tag_deleted = array();
      $arr_tag = array('tag1', 'tag2', 'tag3');
      $data = $this->test_data_aaa($this->arr, $arr_tag, $articles, $tag_deleted);
      echo '<pre>';
      print_r($data);
      exit;
      
        return view('auth.admin.login');
    }

    public function test_data_xxx($data, $arr_tag, $articles, $tag_deleted)
    {
        $limit       = 5;
        $tag_index   = count($tag_deleted);
        $current_tag = isset($arr_tag[$tag_index]) ? $arr_tag[$tag_index] : $arr_tag[0];

        if ($data <= 0 || empty($data) || count($tag_deleted) === count($arr_tag)) {
            return $articles;
        }
        if (count($articles) === 0) {
            $tag_deleted[] = $current_tag;
            if (isset($data[$current_tag]['entry'])) {
                foreach ($data[$current_tag]['entry'] as $item) {
                    $articles[] = $item;
                }
            }
        } else {
            $remain = $limit - count($articles);
            if (isset($data[$current_tag]['entry'])) {
                if (count($data[$current_tag]['entry']) <= $remain) {
                    $tag_deleted[] = $current_tag;
                }
                foreach ($data[$current_tag]['entry'] as $index => $item) {
                    if ($index >= $remain) {
                        break;
                    }
                    $articles[] = $item;
                }
            }
        }
        if (count($articles) === $limit) {
            return array(
                'tag_deleted' => $tag_deleted,
                'articles'    => $articles,
            );
        }

        return $this->test_data_xxx($data, $arr_tag, $articles, $tag_deleted);
    }

    public function test_data_aaa($data, $arr_tag, $articles, $tag_deleted)
    {
        $limit       = 5;
        $tag_index   = count($tag_deleted);
        $current_tag = isset($arr_tag[$tag_index]) ? $arr_tag[$tag_index] : $arr_tag[0];

        if ($data <= 0 || empty($data) || count($tag_deleted) === count($arr_tag)) {
            return $articles;
        }
        if (count($articles) === 0) {
            if ($data[$current_tag]['total'] <= $limit) {
                $tag_deleted[] = $current_tag;
            }
            if (isset($data[$current_tag]['entry'])) {
                foreach ($data[$current_tag]['entry'] as $item) {
                    $articles[] = $item;
                }
            }
        } else {
            $remain = $limit - count($articles);
            if (isset($data[$current_tag]['entry'])) {
                if (count($data[$current_tag]['entry']) <= $remain && $data[$current_tag]['total'] <= $limit) {
                    $tag_deleted[] = $current_tag;
                }
                foreach ($data[$current_tag]['entry'] as $index => $item) {
                    if ($index >= $remain) {
                        break;
                    }
                    $articles[] = $item;
                }
            }
        }
        if (count($articles) === $limit) {
            return array(
                'tag_deleted' => $tag_deleted,
                'articles'    => $articles,
            );
        }

        return $this->test_data_aaa($data, $arr_tag, $articles, $tag_deleted);
    }

    public function test_data($data)
    {
        $limit       = 5;
        $articles    = array();
        $article_next = array();
        $tag_deleted = array();
        $break_loop  = false;

        foreach ($data as $tag => $item) {
            if ($break_loop) {
                break;
            }
            if (! count($articles)) {
                if (isset($item['entry'])) {
                    foreach ($item['entry'] as $article) {
                        $articles[] = $article;
                    }
                }
                if ($item['total'] > $limit) {
                    break;
                } else if ($item['total'] <= $limit) {
                    $tag_deleted[] = $tag;
                    if ($item['total'] == $limit) {
                        break;
                    }
                }
                continue;

            } else {
                $remain = $limit - count($articles);
                if (isset($item['entry'])) {
                    foreach ($item['entry'] as $index => $article) {
                        if ($index < $remain) {
                            $articles[] = $article; 
                            continue;
                        } else {
                            $article_next[] = $article;
                        }
//                        $break_loop = true;
//                        break;
                    }
                    if (count($articles) == $limit && $item['total'] <= $limit) {
                        $tag_deleted[] = $tag;
                        $break_loop = true;
                        break;
                    }
                }
            }
        }
        echo '<pre>';
        print_r($tag_deleted);

        echo '<pre>';print_r($article_next);

        echo '<pre>';
        print_r($articles);
        exit;
    }

    /**
     * Log the user out of the application.
     * Overwrite
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect()->route('admin.login');
    }

    /**
     * @return string
     */
    public function redirectPath()
    {
        return route('admin.dashboard');
    }

    /**
     * Get the guard to be used during authentication.
     * Overwrite
     * 
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }

    /**
     * Get the needed authorization credentials from the request.
     * Overwrite
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $credentials           = $request->only($this->username(), 'password', 'status');
        $credentials['status'] = config('site.user_status.value.active');

        return $credentials;
    }

    /**
     * Get the login username to be used by the controller.
     * Overwrite
     *
     * @return string
     */
    public function username()
    {
        return 'user_name';
    }
}
