<template>
    <section class="site-section pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <swiper ref="mySwiper" :options="swiperOptions">
                        <swiper-slide v-for="post in posts" :key="post.id">
                            <div>
                                <div class="a-block d-flex align-items-center height-lg" :style="{ 'background-image': 'url(' + getPrefixUrlPhoto + post.photo + ')' }">
                                    <div class="text half-to-full">
                                        <span class="category mb-5">{{ $t(post.category_name) }}</span>
                                        <div class="post-meta">

                                            <span class="author mr-2"><img :src="getPrefixUrlPhoto + post.creator.photo" alt="Colorlib"> {{ post.creator.name }}</span>&bullet;
                                            <span class="mr-2">{{ moment(post.created_at).format("DD MM YYYY") }}</span> &bullet;
                                            <span class="ml-2"><span class="fa fa-comments"></span> {{ post.count_comments }}</span>

                                        </div>
                                        <router-link :to="{name: 'post', params:{ id: post.dir }}" class="postIndex">
                                            <h4>{{ post.title }}</h4>
                                        </router-link>
                                    </div>
                                </div>
                            </div>
                        </swiper-slide>

<!--                        <swiper-slide>-->
<!--                            <div>-->
<!--                                <a href="blog-single.html" class="a-block d-flex align-items-center height-lg" style="background-image: url('images/img_2.jpg'); ">-->
<!--                                    <div class="text half-to-full">-->
<!--                                        <span class="category mb-5">Travel</span>-->
<!--                                        <div class="post-meta">-->

<!--                                            <span class="author mr-2"><img src="images/person_1.jpg" alt="Colorlib"> Colorlib</span>&bullet;-->
<!--                                            <span class="mr-2">March 15, 2018 </span> &bullet;-->
<!--                                            <span class="ml-2"><span class="fa fa-comments"></span> 3</span>-->

<!--                                        </div>-->
<!--                                        <h3>How to Find the Video Games of Your Youth</h3>-->
<!--                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem nobis, ut dicta eaque ipsa laudantium!</p>-->
<!--                                    </div>-->
<!--                                </a>-->
<!--                            </div>-->
<!--                        </swiper-slide>-->
<!--                        <swiper-slide>-->
<!--                            <div>-->
<!--                                <a href="blog-single.html" class="a-block d-flex align-items-center height-lg" style="background-image: url('images/img_3.jpg'); ">-->
<!--                                    <div class="text half-to-full">-->
<!--                                        <span class="category mb-5">Sports</span>-->
<!--                                        <div class="post-meta">-->

<!--                                            <span class="author mr-2"><img src="images/person_1.jpg" alt="Colorlib"> Colorlib</span>&bullet;-->
<!--                                            <span class="mr-2">March 15, 2018 </span> &bullet;-->
<!--                                            <span class="ml-2"><span class="fa fa-comments"></span> 3</span>-->

<!--                                        </div>-->
<!--                                        <h3>How to Find the Video Games of Your Youth</h3>-->
<!--                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem nobis, ut dicta eaque ipsa laudantium!</p>-->
<!--                                    </div>-->
<!--                                </a>-->
<!--                            </div>-->
<!--                        </swiper-slide>-->
                        <div class="swiper-pagination" slot="pagination"></div>
                        <div class="swiper-button-prev" slot="button-prev"></div>
                        <div class="swiper-button-next" slot="button-next"></div>
                    </swiper>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import { Swiper, SwiperSlide } from 'vue-awesome-swiper'
    import { mapActions, mapGetters } from 'vuex'
    import moment from "moment";

    export default {
        data() {
            return {
                swiperOptions: {
                    spaceBetween: 30,
                    centeredSlides: true,
                    watchOverflow: true,
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev'
                    },
                },
                moment: moment,
            }
        },
        components: {Swiper, SwiperSlide},
        computed: {
            ...mapGetters({
                posts: 'getRandomPosts',
                getPrefixUrlPhoto: 'getPrefixUrlPhoto',
            })
        },
        created() {
            this.randomPosts()
        },
        methods: {
            ...mapActions({
                randomPosts: 'randomPosts'
            }),
        }
    }
</script>

<style scoped>
    .swiper-button-next, .swiper-button-prev {
        opacity: 0;
    }

    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        opacity: 1;
    }
    .swiper-button-disabled {
        opacity: 0 !important;
    }
     .postIndex {
         text-decoration: none;
         color: white;
     }
</style>

