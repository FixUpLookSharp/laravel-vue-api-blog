export default {
    actions: {
        async changeUser(ctx, data) {

           const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            let  data2 = await new FormData();
            await data2.append('name', data.name)
            await data2.append('email', data.email)
            await data2.append('nickname', data.nickname)
            await data2.append('info', data.info)
            await data2.append('address', data.address)
            await data2.append('phone', data.phone)
            await data2.append('vk', data.vk)
            await data2.append('facebook', data.facebook)
            await data2.append('instagram', data.instagram)
            if (data.photo) await data2.append('photo', data.photo)
            await axios.post('/api/V1/user/change-user', data2, config)
                .then(function (res) {
                })
                .catch(function (err) {
                });
        }
    },
    mutations: {

    },
    state: {

    },
    getters: {

    }
}
