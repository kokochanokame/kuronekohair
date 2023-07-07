<?php

//テーマ機能の有効化
function mu_theme_setup()
{

    //タグタイトルの有効化
    add_theme_support('title-tag');

    //アイキャッチ画像の有効化
    add_theme_support('post-thumbnails');

    //検索フォームの有効化
    add_theme_support('html5', array('search-form'));

    //アイキャッチ画像のサイズ指定
    add_image_size('page_eyecatch', 1100, 610, true);

    //記事一覧画像のサイズ指定
    add_image_size('archive_thumbnail', 200, 150, true);

    //メニューの有効化
    register_nav_menus(
        array(
            'main-menu' => 'メインメニュー',
            'footer-menu' => 'フッターメニュー'
        )
    );

}
add_action('after_setup_theme', 'mu_theme_setup');

function mu_enqueue_scripts()
{

    //jsファイルの読み込み
    wp_enqueue_script('jquery');
    wp_enqueue_script(
        'kuroneko-theme-common',
        get_template_directory_uri() . '/assets/js/theme-common.js',
        array(),
        '1.0.0',
        true
    );

    //cssファイルの読み込み
    wp_enqueue_style(
        'googlefonts',
        'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500&display=swap',
        array(),
        '1.0.0'
    );
    wp_enqueue_style(
        'kuroneko-theme-styles',
        get_template_directory_uri() . '/assets/css/theme-styles.css',
        array(),
        '1.0.0'
    );
}
add_action('wp_enqueue_scripts', 'mu_enqueue_scripts');

//ウィジェットエリア機能有効化
function mu_widgets_init(){
    register_sidebar(
        array(
            'name'          =>'サイドバー',
            'id'            =>'sidebar-widget-area',
            'description'   =>'投稿・固定ページのサイドバー',
            'before_widget' =>'<div id="%1$s" class="%2$s">',
            'after_widget'  =>'</div>',
        )
        );
        register_sidebars(
            3,
            array(
                'name'          =>'フッター %d',
                'id'            =>'footer-widget-area',
                'description'   =>'フッターのサイドバー',
                'before_widget' =>'<div id="%1$s" class="%2$s">',
                'after_widget'  =>'</div>',
            )
            );
}
add_action('widgets_init','mu_widgets_init');

function mu_block_setup(){
    //ブロックスタイルの有効化
    add_theme_support('wp-block-styles');

    //埋め込みコンテンツのレスポンシブ化
    add_theme_support('responsive-embeds');

   // ブラックスタイルの幅広
   add_theme_support('align-wide');

   //テーマカラーの設定
    add_theme_support(
        'editor-color-palette',
        array(
            array(
                'name'=>'スカイブルー',
                'slug' =>'skyblue',
                'color'=>'#00A1C6',
            ),

            array(
                'name'=>'ライトスカイブルー',
                'slug'=>'light-skyblue',
                'color'=>'#ECF5F7'
            ),
            array(
                'name'=>'グレー',
                'slug'=>'gray',
                'color'=>'#767268',
            ),
            array(
                'name'=>'ダークグレー',
                 'slug'=>'dark-gray',
                 'color'=>'#43413B',   
    
            ),
        )
        );
//フォントサイズの指定
        add_theme_support(
            'editor-font-sizes',
            array(
                array(
                    'name'=>'極小',
                    'size'=>'14',
                    'slug'=>'x-small',
                ),
                array(
                    'name'=>'小',
                    'size'=>'16',
                    'slug'=>'small',
                ),
                array(
                    'name'=>'標準',
                    'size'=>18,
                    'slug'=>'normal',
                ),
                array(
                    'name'=>'大',
                    'size'=>'24',
                    'slug'=>'large',
                ),
                array(
                    'name'=>'特大',
                    'size'=>'36',
                    'slug'=>'huge',
                ),
            )
            );
            //エディッターのスタイルを有効か
            add_theme_support('editor-styles');
            //エディッターにスタイルを読み込む
            add_editor_style('assets/css/editor-styles.css');
            //エディッターにGoogleフォントを読み込む
            add_editor_style('https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500&display=swap');

}
add_action('after_setup_theme','mu_block_setup');


//独自スタイルを追加
function mu_block_style_setup(){
    register_block_style(
        'core/button',
        array(
            'name'=>'arrow',
            'label'=>'矢印付き',
        )
    );
    register_block_style(
        'core/button',
        array(
            'name'=>'fixed',
            'label'=>'幅固定',
        )
        );
}
add_action('after_setup_theme','mu_block_style_setup');

//コアブロックを削除する
function mu_remove_block_patterns(){
    remove_theme_support('core-block-patterns');
}
add_action('after_setup_theme', 'mu_remove_block_patterns');


//ブロックバターンの登録
function mu_register_block_patterns(){
    register_block_pattern(
        'mu/campaign',
        array(
            'title'     =>'キャンペーン内容',
            'categories' =>array('text'),
            'description'=>'キャンペーン用のパターンです',
            'content'   =>'<!-- wp:heading -->
<h2 class="wp-block-heading">キャンペーン実施</h2>
<!-- /wp:heading -->

<!-- wp:html -->
<p>湿気で髪型も決まらないし、お出かけが億劫になる雨の日。みなさまに少しでも楽しく過ごしていただきたいという思いから、Kuroneko Hairでは雨の日キャンペーンを開催することにいたしました。</p>
<p>当日のご予約でもOKです、ぜひこの機会にご利用ください。</p>
<h2>キャンペーン内容</h2>
<table><tbody><tr><td>対象日</td><td>キャンペーン期間中、ご来店時に雨が降っていたお客様</td></tr><tr><td>期間</td><td>2021年3月14日〜3月31日</td></tr><tr><td>内容</td><td>施術料金のお会計総額から、15％OFF<br>※物販は割引適用外となります。その他の割引・クーポンとの併用は致しかねます。</td></tr></tbody></table>
<p><a class="wp-block-button__link" href="#">来店ご予約はこちら</a></p>
<!-- /wp:html -->

<!-- wp:table -->
<figure class="wp-block-table"><table><tbody><tr><td>対象日</td><td>２０２３年６月２２日から２９日</td></tr><tr><td>内容</td><td>5000円以上のお買い物で抽選券がもらえる</td></tr></tbody></table></figure>
<!-- /wp:table -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button ',
            'viewportWidth'=>710,
        )
        );
}
add_action('init','mu_register_block_patterns');

//ショートコード
function neko_news_shortcode() {
    $neko_news_html = '';
    $neko_args       = array(
        'post_type'      => 'post',
        'posts_per_page' => 3,
    );
    $neko_news_query = new WP_Query( $neko_args );
    if ( $neko_news_query->have_posts() ) {
        $neko_news_html .= '<div class="row justify-content-center"><div class="col-lg-10">';
        while ( $neko_news_query->have_posts() ) {
            $neko_news_query->the_post();
            $neko_post_class = get_post_class( 'module-Article_Item' );
            $neko_category_list = get_the_category();
            $neko_news_html .= '<article id="post-' . get_the_ID() . '" class="' . esc_attr( implode( ' ', $neko_post_class ) ) . '">';
            $neko_news_html .= '<a href="' . get_the_permalink() . '" class="module-Article_Item_Link">';
            $neko_news_html .= '<div class="module-Article_Item_Img">';
            if ( has_post_thumbnail() ) {
                $neko_news_html .= get_the_post_thumbnail();
            } else {
                $neko_news_html .= '<img src="' . esc_url( get_template_directory_uri() ) . '/assets/img/dummy-image.png" alt="" width="200" height="150" load="lazy">';
            }
            $neko_news_html .= '</div>';
            $neko_news_html .= '<div class="module-Article_Item_Body">';
            $neko_news_html .= '<h2 class="module-Article_Item_Title">' . get_the_title() . '</h2>';
            $neko_news_html .= get_the_excerpt();
            $neko_news_html .= '<ul class="module-Article_Item_Meta">';
            if ( $neko_category_list ) {
                $neko_news_html .= '<li class="module-Article_Item_Cat">' . esc_html( $neko_category_list[0]->name ) . '</li>';
            }
            $neko_news_html .= '<li class="module-Article_Item_Date">';
            $neko_news_html .= '<time datetime="' . get_the_date( 'Y-m-d' ) . '">' . get_the_date() . '</time>';
            $neko_news_html .= '</li></ul></div></a></article>';
        }
        wp_reset_postdata();
        $neko_news_html .= '</div></div>';
    }
    return $neko_news_html;
}
add_shortcode( 'neko_news_recently', 'neko_news_shortcode' );


function neko_hair_styles_shortcode() {
    $neko_hairstyles_html = '';
    $neko_args             = array(
        'post_type'      => 'hairstyles',
        'posts_per_page' => 4,
    );
    $neko_hairstyles_query = new WP_Query( $neko_args );
    if ( $neko_hairstyles_query->have_posts() ) {
        $neko_hairstyles_html .= '<div class="row">';
        while ( $neko_hairstyles_query->have_posts() ) {
            $neko_hairstyles_query->the_post();
            $neko_post_class = get_post_class( 'module-Style_Item' );
            $neko_hairstyles_html .= '<div class="col-6 col-md-3">';
            $neko_hairstyles_html .= '<div id="post-' . get_the_ID() . '" class="' . esc_attr( implode( ' ', $neko_post_class ) ) . '">';
            $neko_hairstyles_html .= '<a href="' . get_the_permalink() . '" class="module-Style_Item_Link" title="' . get_the_title() . '">';
            $neko_hairstyles_html .= '<figure class="module-Style_Item_Img">';
            if ( has_post_thumbnail() ) {
                $neko_hairstyles_html .= get_the_post_thumbnail();
            }
            $neko_hairstyles_html .= '</figure>';
            $neko_hairstyles_html .= '</a>';
            $neko_hairstyles_html .= '</div>';
            $neko_hairstyles_html .= '</div>';
        }
        wp_reset_postdata();
        $neko_hairstyles_html .= '</div>';
    }
    return $neko_hairstyles_html;
}
add_shortcode( 'neko_hairstyles_recently', 'neko_hair_styles_shortcode' );
?>