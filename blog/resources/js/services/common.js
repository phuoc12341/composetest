export default {
    search(searchUrl, searchData) {
        return axios.get(searchUrl, {params: searchData});
    },
    create(createUrl, data) {
        return axios.get(createUrl, {params: data});
    },
    edit(url, data) {
        return axios.get(url, {params: data});
    },
    update(url) {
        return axios.put(url);
    },
    store(url) {
        return axios.post(url);
    },
    delete(destroyUrl) {
        return axios.delete(destroyUrl);
    },
    recover(recoverUrl, id) {
        return axios.post(recoverUrl, {id: id});
    },
    reExec(execUrl, data) {
        return axios.post(execUrl, {data});
    },
    config() {


    },
}
