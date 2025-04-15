<?php
/**
 *  Поверка существования функции
 */
function helperFunctionCheck( $func ): bool
{
    if( function_exists($func) )
        dd("The helper function '$func' already exists.");

    return true;
}

if( helperFunctionCheck('users') ){

    /**
     * @param bool $refresh
     * @return \App\ServicesYz\UsersService
     */
    function users( bool $refresh = false ) : \App\ServicesYz\UsersService
    {
        static $users_service_instance = false;

        if( $refresh )
            $users_service_instance = false;

        if( !$users_service_instance )
            $users_service_instance = new \App\ServicesYz\UsersService();

        return $users_service_instance;
    }
}

if( helperFunctionCheck('projects') ) {

    /**
     * @param bool $refresh
     * @return \App\ServicesYz\TasksProjectsService
     */
    function projects( bool $refresh = false ) : \App\ServicesYz\TasksProjectsService
    {
        static $projects_service_instance = false;

        if( $refresh )
            $projects_service_instance = false;

        if( !$projects_service_instance )
            $projects_service_instance = new \App\ServicesYz\TasksProjectsService;

        return $projects_service_instance;
    }
}
if( helperFunctionCheck('sections') ) {

    /**
     * @param bool $refresh
     * @return \App\ServicesYz\TaksksSectionsService
     */
    function sections( bool $refresh = false ) : \App\ServicesYz\TaksksSectionsService
    {
        static $sections_service_instance = false;

        if( $refresh )
            $sections_service_instance = false;

        if( !$sections_service_instance )
            $sections_service_instance = new \App\ServicesYz\TaksksSectionsService;

        return $sections_service_instance;
    }
}

if( helperFunctionCheck('postCategories') ){

    /**
     * @param bool $refresh
     * @return \App\ServicesYz\PostCategoriesService
     */
    function postCategories( bool $refresh = false ) : \App\ServicesYz\PostCategoriesService
    {
        static $post_categories_service_instance = false;

        if( $refresh )
            $post_categories_service_instance = false;

        if( !$post_categories_service_instance )
            $post_categories_service_instance = new \App\ServicesYz\PostCategoriesService();

        return $post_categories_service_instance;
    }

}
if( helperFunctionCheck('posts') ){

    /**
     * @param bool $refresh
     * @return \App\ServicesYz\PostsService
     */
    function posts( bool $refresh = false ) : \App\ServicesYz\PostsService
    {
        static $posts_service_instance = false;

        if( $refresh )
            $posts_service_instance = false;

        if( !$posts_service_instance )
            $posts_service_instance = new \App\ServicesYz\PostsService();

        return $posts_service_instance;
    }

}
if( helperFunctionCheck('postReviews') ){
    function postReviews( bool $refresh = false ) : \App\ServicesYz\PostReviewsService
    {
        static $post_reviews_service_instance = false;

        if( $refresh )
            $post_reviews_service_instance = false;

        if( !$post_reviews_service_instance )
            $post_reviews_service_instance = new \App\ServicesYz\PostReviewsService();

        return $post_reviews_service_instance;
    }
}
if( helperFunctionCheck('postTags') ){
    function postTags( bool $refresh = false ) : \App\ServicesYz\PostTagsService
    {
        static $post_tags_service_instance = false;

        if( $refresh )
            $post_tags_service_instance = false;

        if( !$post_tags_service_instance )
            $post_tags_service_instance = new \App\ServicesYz\PostTagsService();

        return $post_tags_service_instance;
    }
}
if( helperFunctionCheck('settings') ){
    function settings( bool $refresh = false ) : \App\ServicesYz\SettingsService
    {
        static $settings_service_instance = false;

        if( $refresh )
            $settings_service_instance = false;

        if( !$settings_service_instance )
            $settings_service_instance = new \App\ServicesYz\SettingsService();

        return $settings_service_instance;
    }
}
