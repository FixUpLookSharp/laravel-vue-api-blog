<template>
    <div>
        <carousel-component></carousel-component>
        <section class="site-section py-sm">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="mb-4">Последние статьи</h2>
                    </div>
                </div>
                <!-- sidebar -->
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
    import CarouselComponent from "./CarouselComponent";
    import PostsComponent from "./PostsComponent"
    import IndexSearchComponent from "./IndexSearchComponent";
    import TopWeekComponent from "./TopWeekComponent";
    import PopularPostComponent from "./PopularPostComponent";
    import IndexCategoriesComponent from "./IndexCategoriesComponent";

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

