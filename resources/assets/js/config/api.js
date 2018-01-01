/**
 *
 * User: 梁晓伟  lxw11109@gmail.com
 * Date: 2017-09-23
 * Time: 10:17
 */
import config from './api.config'

let api = {
    //登录
    login: config.host + config.prefix + '/login',
}

export default {
    api: api,
}