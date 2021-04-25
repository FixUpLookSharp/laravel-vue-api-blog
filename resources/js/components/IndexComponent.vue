<template>
    <div>
        <carousel-component></carousel-component>
        <section class="site-section py-sm">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="mb-4">Latest Posts</h2>
                    </div>
                </div>
                <div class="row blog-entries">
                    <posts-component></posts-component>
                    <div class="col-md-12 col-lg-4 sidebar">
                        <!-- sidebar-box -->
                        <index-search-component></index-search-component>
                        <top-week-component></top-week-component>
                        <popular-post-component></popular-post-component>
                        <index-categories-component></index-categories-component>
                        <!-- END sidebar-box -->
                    </div>
                    <!-- END sidebar -->

                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    import CarouselComponent from "../views/index/CarouselComponent";
    import PostsComponent from "../views/index/PostsComponent"
    import IndexSearchComponent from "../views/index/IndexSearchComponent";
    import TopWeekComponent from "../views/index/TopWeekComponent";
    import PopularPostComponent from "../views/index/PopularPostComponent";
    import IndexCategoriesComponent from "../views/index/IndexCategoriesComponent";

    export default {
        components: {
            CarouselComponent,
            PostsComponent,
            IndexSearchComponent,
            TopWeekComponent,
            PopularPostComponent,
            IndexCategoriesComponent
        },
        computed: {
          ...mapGetters({
              getAuth: 'getAuth',
              getCategories: 'getCategories'

          }),
        },
        mounted() {
        }

    }
</script>

