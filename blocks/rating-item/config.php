<?php 

add_action('wp', function(){

    if(empty($_GET['go_block_url'])){
        return;
    }

    $blockId = $_GET['go_block_url'];
    $post = get_post();
    $blocks = parse_blocks($post->post_content);
    $blockWithUrl = null;
    foreach($blocks as $item){
        $itemBlockId = $item['attrs']['blockId'] ?? null;
        if($itemBlockId == $blockId){
            $blockWithUrl = $item;
            break;
        }

        if(isset($item['innerBlocks'])){
            foreach($item['innerBlocks'] as $item){
                $itemBlockId = $item['attrs']['blockId'] ?? null;
                if($itemBlockId == $blockId){
                    $blockWithUrl = $item;
                    break;
                }
            }
        }

    }

    $url = $blockWithUrl['attrs']['url'] ?? null;
    // dd($url);
    if(empty($url)){
        return;
    }

    $url = apply_filters('reagg/rating_item_url', $url);

    wp_redirect($url);
    exit;
});

function reagg_get_url_for_block($blockId, $post_id){
    $url = get_permalink($post_id);
    return add_query_arg('go_block_url', $blockId, $url);
}

add_action( 'lzb/init', function() {

    lazyblocks()->add_block( array(
        'id' => 25338,
        'title' => 'rating item',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM5 4.99h3C8 6.65 6.66 8 5 8V4.99zM5 12v-2c2.76 0 5-2.25 5-5.01h2C12 8.86 8.87 12 5 12zm0 6l3.5-4.5 2.5 3.01L14.5 12l4.5 6H5z" /></svg>',
        'keywords' => array(
        ),
        'slug' => 'lazyblock/rating-item',
        'description' => '',
        'category' => 'text',
        'category_label' => 'text',
        'supports' => array(
            'customClassName' => true,
            'anchor' => false,
            'align' => array(
                0 => 'wide',
                1 => 'full',
            ),
            'html' => false,
            'multiple' => true,
            'inserter' => true,
        ),
        'ghostkit' => array(
            'supports' => array(
                'spacings' => false,
                'display' => false,
                'scrollReveal' => false,
                'frame' => false,
                'customCSS' => false,
            ),
        ),
        'controls' => array(
            'control_577bd7437a' => array(
                'type' => 'url',
                'name' => 'url-internal',
                'default' => '',
                'label' => 'url-internal',
                'help' => 'product url by WooCommerce - если есть, иначе заполняем поля ниже (если указать ссылку на продукт, то многие поля возьмутся из продукта сразу)',
                'child_of' => '',
                'placement' => 'content',
                'width' => '100',
                'hide_if_not_selected' => 'true',
                'required' => 'false',
                'translate' => 'false',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
                'placeholder' => '',
                'characters_limit' => '',
            ),
            'control_d8cb28496d' => array(
                'type' => 'text',
                'name' => 'name',
                'default' => '',
                'label' => 'name',
                'help' => '',
                'child_of' => '',
                'placement' => 'content',
                'width' => '100',
                'hide_if_not_selected' => 'true',
                'required' => 'false',
                'translate' => 'false',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
                'placeholder' => '',
                'characters_limit' => '',
            ),
            'control_f848d248b8' => array(
                'type' => 'text',
                'name' => 'excerpt',
                'default' => '',
                'label' => 'excerpt',
                'help' => '',
                'child_of' => '',
                'placement' => 'content',
                'width' => '100',
                'hide_if_not_selected' => 'true',
                'required' => 'false',
                'translate' => 'false',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
                'placeholder' => '',
                'characters_limit' => '',
            ),
            'control_0929904e54' => array(
                'type' => 'text',
                'name' => 'features',
                'default' => '',
                'label' => 'features',
                'help' => 'специальное выделение - главное преимущество',
                'child_of' => '',
                'placement' => 'content',
                'width' => '100',
                'hide_if_not_selected' => 'true',
                'required' => 'false',
                'translate' => 'false',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
                'placeholder' => '',
                'characters_limit' => '',
                'multiline' => 'true',
            ),
            'control_d20add4ace' => array(
                'type' => 'text',
                'name' => 'url',
                'default' => '',
                'label' => 'url',
                'help' => '',
                'child_of' => '',
                'placement' => 'content',
                'width' => '100',
                'hide_if_not_selected' => 'true',
                'required' => 'false',
                'translate' => 'false',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
                'placeholder' => '',
                'characters_limit' => '',
            ),
            'control_5a990c40a7' => array(
                'type' => 'image',
                'name' => 'image',
                'default' => '',
                'label' => 'image',
                'help' => '',
                'child_of' => '',
                'placement' => 'content',
                'width' => '100',
                'hide_if_not_selected' => 'true',
                'required' => 'false',
                'translate' => 'false',
                'save_in_meta' => 'false',
                'save_in_meta_name' => '',
                'preview_size' => 'medium',
                'placeholder' => '',
                'characters_limit' => '',
            ),
        ),
        'code' => array(
            'output_method' => 'template',
            'editor_html' => '',
            'editor_callback' => '',
            'editor_css' => '',
            'frontend_html' => '',
            'frontend_callback' => '',
            'frontend_css' => '',
            'show_preview' => 'always',
            'single_output' => false,
        ),
        'condition' => array(
        ),
    ) );
    
} );
