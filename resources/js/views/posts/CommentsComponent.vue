<template>
    <div class="container d-flex justify-content-left mt-100 mb-100">
        <div class="row">
            <div class="col-md-12">
                    <div class="card-body">
                        <h4 class="card-title">Последние коментарии</h4>
                    </div>
                    <div class="comment-widgets m-b-20">
                        <div v-for="(comment, index) in comments" :key="comment.id" class="d-flex flex-row comment-row">
                            <div class="p-2"><span class="round"><img :src="prefixUrlPhoto + comment.creator.photo" alt="user" width="50"></span></div>
                            <div class="comment-text w-100">
                                <h5>{{ comment.creator.name }}</h5>
                                <div class="comment-footer">
                                    <span class="date">{{ moment(comment.created_at).format('DD.MM.YYYY') }}</span>
                                    <span class="action-icons">
                                        <a v-if="comment.creator.id == auth.id && comment.id != update.id" @click="commentUpdateShow(comment.id, comment.content)" class="update">
                                        <i class="fa fa-pencil"></i>
                                        </a>
                                        <a v-if="comment.creator.id == auth.id && update.comment && comment.id == update.id" @click="commentUpdate({id: update.id, content: update.content}, index)" class="update">
                                        <i class="fas fa-save"></i>
                                        </a>
                                        <a v-if="comment.creator.id == auth.id" @click="commentDelete(comment.id, index)" class="delete">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
<!--                                        <a href="#" data-abc="true">-->
<!--                                        <i class="fa fa-heart"></i></a>-->
                                    </span>
                                </div>
                                <p v-if="comment.id != update.id" class="m-b-5 m-t-10 p-block">{{ comment.content }}</p>
                                <textarea v-if="comment.id == update.id && update.comment" type="text" v-model="update.content" class="update-textarea form-control"></textarea>
                            </div>
                        </div>
<!--                        <div class="d-flex flex-row comment-row">-->
<!--                            <div class="p-2"><span class="round"><img src="https://i.imgur.com/uIgDDDd.jpg" alt="user" width="50"></span></div>-->
<!--                            <div class="comment-text">-->
<!--                                <h5>Samso Nagaro</h5>-->
<!--                                <div class="comment-footer"> <span class="date">April 14, 2019</span> <span class="label label-info">Pending</span> <span class="action-icons"> <a href="#" data-abc="true"><i class="fa fa-pencil"></i></a> <a href="#" data-abc="true"><i class="fa fa-rotate-right"></i></a> <a href="#" data-abc="true"><i class="fa fa-heart"></i></a> </span> </div>-->
<!--                                <p class="m-b-5 m-t-10">-->
<!--                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it-->
<!--                                </p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="d-flex flex-row comment-row ">-->
<!--                            <div class="p-2"><span class="round"><img src="https://i.imgur.com/tT8rjKC.jpg" alt="user" width="50"></span></div>-->
<!--                            <div class="comment-text active w-100">-->
<!--                                <h5>Jonty Andrews</h5>-->
<!--                                <div class="comment-footer"> <span class="date">March 13, 2020</span> <span class="label label-success">Approved</span> <span class="action-icons active"> <a href="#" data-abc="true"><i class="fa fa-pencil"></i></a> <a href="#" data-abc="true"><i class="fa fa-rotate-right text-success"></i></a> <a href="#" data-abc="true"><i class="fa fa-heart text-danger"></i></a> </span> </div>-->
<!--                                <p class="m-b-5 m-t-10">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="d-flex flex-row comment-row">-->
<!--                            <div class="p-2"><span class="round"><img src="https://i.imgur.com/cAdLHeY.jpg" alt="user" width="50"></span></div>-->
<!--                            <div class="comment-text w-100">-->
<!--                                <h5>Sarah Tim</h5>-->
<!--                                <div class="comment-footer"> <span class="date">Jan 20, 2020</span> <span class="label label-danger">Rejected</span> <span class="action-icons"> <a href="#" data-abc="true"><i class="fa fa-pencil"></i></a> <a href="#" data-abc="true"><i class="fa fa-rotate-right"></i></a> <a href="#" data-abc="true"><i class="fa fa-heart"></i></a> </span> </div>-->
<!--                                <p class="m-b-5 m-t-10">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="d-flex flex-row comment-row">-->
<!--                            <div class="p-2"><span class="round"><img src="https://i.imgur.com/uIgDDDd.jpg" alt="user" width="50"></span></div>-->
<!--                            <div class="comment-text w-100">-->
<!--                                <h5>Samso Nagaro</h5>-->
<!--                                <div class="comment-footer"> <span class="date">March 20, 2020</span> <span class="label label-info">Pending</span> <span class="action-icons"> <a href="#" data-abc="true"><i class="fa fa-pencil"></i></a> <a href="#" data-abc="true"><i class="fa fa-rotate-right"></i></a> <a href="#" data-abc="true"><i class="fa fa-heart"></i></a> </span> </div>-->
<!--                                <p class="m-b-5 m-t-10">It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>-->
<!--                            </div>-->
<!--                        </div>-->
                        <a v-if="!active.allComment && loadButton" @click="loadMore" class="btn btn-primary btn-sm btn-block mb-4" role="button"><span class="glyphicon glyphicon-refresh"></span> Загрузить старые</a>
                        <a v-else-if="active.allComment && !loadButton" class="btn btn-success btn-sm btn-block mb-4" role="button"><span class="glyphicon glyphicon-refresh"></span> {{ active.message }}</a>
                        <div v-if="authStatus" class="d-flex flex-row add-comment-section mb-4">
                            <img class="img-fluid img-responsive rounded-circle mr-2" :src="prefixUrlPhoto + auth.photo" width="38">
                            <input @keyup.enter="addComment({content: content, article_id: postId, creator_id: auth.id})" type="text" :class="[errors ? 'is-invalid' : '']" class="form-control mr-3" v-model="content" placeholder="Добавить Коментарий"><br>
                            <button @click="addComment({content: content, article_id: postId, creator_id: auth.id})" class="btn btn-primary" type="button">Добавть</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment'
    import { mapGetters, mapActions, mapMutations } from 'vuex'
    export default {
        data: function () {
          return {
              content: '',
              active: {
                  allComment: false,
                  message: '',
              },
              update: {
                  id: 0,
                  comment: false,
                  content: '',
              },
              moment: moment,
          }
        },
        props: [
          'postId'
        ],
        computed: {
            ...mapGetters({
                auth: 'getAuth',
                prefixUrlPhoto: 'getPrefixUrlPhoto',
                authStatus: 'getAuthStatus',
                comments: 'getComments',
                errors: 'getErrorsComments',
                loadButton: 'getCommentLoadButton',
            })
        },
        mounted() {
            this.showComments(this.$route.params.id)
        },
        watch: {
            content: function (e) {
                this.updateCommentErrors(null)
            }
        },
        methods: {
            ...mapActions({
                showComments: 'showComments',
            }),
            ...mapMutations({
                updateComments: 'updateComments',
                updateCommentErrors: 'updateCommentErrors',
                updateCommentButton: 'updateCommentButton',
            }),
            async addComment(data) {
                let app = this
                await axios({
                    method: 'post',
                    url: '/api/V1/comment',
                    data: {
                        content: data.content,
                        creator_id: data.creator_id,
                        article_id: data.article_id,
                    }
                }).then((response) => {
                    app.content = ''
                    this.comments.push(response.data)
                }).catch(error => {
                    let errors = error.response.data.errors.content ? error.response.data.errors.content[0] : null
                    this.updateCommentErrors(errors)
                })
            },
            async loadMore() {
                let currLenghtElement = this.comments.length
                let article_id = this.postId
                await axios({
                    method: 'get',
                    url: '/api/V1/comment',
                    params: {
                        lenght: currLenghtElement,
                        article_id: article_id,
                    }
                }).then((response) => {
                    if (response.data.allComment) {
                        this.active.allComment = response.data.allComment
                        this.active.message = response.data.message
                        this.updateCommentButton(false)
                        return;
                    }
                    this.updateComments(response.data)
                })
            },
            async commentUpdateShow(commentId, content) {
                this.update.comment = true
                this.update.id = commentId
                this.update.content = content
            },
            async commentUpdate(comment, index) {
                await axios({
                    method: 'put',
                    url: '/api/V1/comment/' + comment.id,
                    data: {
                        content: comment.content
                    }
                }).then((response) => {
                    this.comments[index].content = response.data.content
                    this.update.comment = false
                    this.update.id = 0
                })
            },

            async commentDelete(id, index) {
                await axios({
                    method: 'delete',
                    url: '/api/V1/comment/' + id,
                }).then((response) => {
                    this.comments.splice(index, 1)
                })
            },
        },
    }
</script>



<style scoped>
    .add-comment-section {
        padding-top: 25px;
    }

    @media (min-width: 440px) and (max-width: 767px){
        .comment-widgets {
            width: 100%;
        }
    }

    @media (min-width: 768px) {
        .comment-widgets {
            width: 680px;
        }
    }

    .action-icons .update {
        color: #0ba360;
        cursor: pointer;
    }
    .update-textarea {
        border: 1px solid #a1a0a0;
        resize: none;
    }

    .action-icons .delete {
        color: red;
        cursor: pointer;
    }
</style>
