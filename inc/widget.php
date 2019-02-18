<?php

class pure_widget1 extends WP_Widget {
 
    function __construct() {
        // Instantiate the parent object
        parent::__construct( 'hot_tags', '标签' );
    }

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title',esc_attr($instance['title']));
        $limit = strip_tags($instance['limit']) ? strip_tags($instance['limit']) : 5;
        echo $before_widget;
        if( $title ) echo $before_title.$title.$after_title;
        echo get_hot_tag_list();
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['limit'] = strip_tags($new_instance['limit']);

        return $instance;
    }
    function form($instance) {
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('title'=> '', 'limit' => ''));
        $title = esc_attr($instance['title']);
        $limit = strip_tags($instance['limit']);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">标题：<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>">显示数量：<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label>
        </p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
        <?php
    }
}
add_action('widgets_init', 'pure_widget1_init');
function pure_widget1_init() {
    register_widget('pure_widget1');
}

class pure_widget2 extends WP_Widget {


    function __construct() {
        // Instantiate the parent object
        parent::__construct( 'hit-posts', '热门文章' , array('description' => '热门文章s'));
    }

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title',esc_attr($instance['title']));
        $limit = strip_tags($instance['limit']) ? strip_tags($instance['limit']) : 5;
        echo $before_widget;
        if( $title ) echo $before_title.$title.$after_title;
        echo get_widget_posts($limit);
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['limit'] = strip_tags($new_instance['limit']);

        return $instance;
    }
    function form($instance) {
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('title'=> '', 'limit' => ''));
        $title = esc_attr($instance['title']);
        $limit = strip_tags($instance['limit']);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">标题：<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>">显示数量：<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label>
        </p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
        <?php
    }
}
add_action('widgets_init', 'pure_widget2_init');
function pure_widget2_init() {
    register_widget('pure_widget2');
}

class pure_widget3 extends WP_Widget {
    

    function __construct() {
        // Instantiate the parent object
         $widget_ops = array('description' => '关于站长小工具');
        parent::__construct( 'about', '关于站长', $widget_ops );
    }

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title',esc_attr($instance['title']));
        $limit = strip_tags($instance['limit']) ? strip_tags($instance['limit']) : 5;
        echo $before_widget;
        if( $title ) echo $before_title.$title.$after_title;
        $user = get_user_by('ID',1);

        ?>
        <div class="widget-card">
            <div class="widget-card-imageWrapper">
                <?php echo get_avatar(1,32);?>
            </div>
            <div class="widget-card-content"><?php echo $user->display_name;?></div>
            <div class="widget-card-description">
                <p><?php echo $user->description;?></p>
            </div>
            <div class="widget-card-info">
                <p class="widget-card-infoTitle">elsewhere</p>
                <?php pure_sns('widget-icons');?>
            </div>
        </div>
        <?php echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['limit'] = strip_tags($new_instance['limit']);

        return $instance;
    }
    function form($instance) {
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('title'=> '', 'limit' => ''));
        $title = esc_attr($instance['title']);
        $limit = strip_tags($instance['limit']);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">标题：<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label>
        </p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
        <?php
    }
}
add_action('widgets_init', 'pure_widget3_init');
function pure_widget3_init() {
    register_widget('pure_widget3');
}

class pure_widget5 extends WP_Widget {
    function pure_widget5() {
        $widget_ops = array('description' => '最近评论');
        $this->__construct('comments', '最近评论', $widget_ops);
    }

    function __construct() {
        // Instantiate the parent object

         $widget_ops = array('description' => '最近评论');
        parent::__construct('comments', '最近评论', $widget_ops);
        
    }

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title',esc_attr($instance['title']));
        $limit = strip_tags($instance['limit']) ? strip_tags($instance['limit']) : 5;
        $output = '';
        echo $before_widget;
        if( $title ) echo $before_title.$title.$after_title. '<ul class="notificationsList">';
        $args = array(
            'number' => 5,
            'author__not_in' => 1
        );
        $comments = get_comments($args);
        global $comment;
        foreach ($comments as $key => $comment) {
            $output .= '<li class="notificationsList-item">
<div class="notificationsList-userAvatarIcon">' . get_avatar($comment,40) . '</div>
<a class="notificationsList-button" rel="nofollow" href="' .get_comment_link( $comment->comment_ID) . '">
' . $comment->comment_content . '
<span class="notificationsList-meta">
<span class="cute">' . $comment->comment_author . '</span>
发布于' . human_time_diff(get_comment_date('U')) . '前
</span>
</a>
</li>';
        }

        echo $output . '</ul>';
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['limit'] = strip_tags($new_instance['limit']);

        return $instance;
    }
    function form($instance) {
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('title'=> '', 'limit' => ''));
        $title = esc_attr($instance['title']);
        $limit = strip_tags($instance['limit']);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">标题：<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>">显示数量：<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label>
        </p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
        <?php
    }
}
add_action('widgets_init', 'pure_widget5_init');
function pure_widget5_init() {
    register_widget('pure_widget5');
}