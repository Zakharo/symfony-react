import axios from "axios";

export const requestService = {
    getTracks,
    create,
    del,
};

function getTracks() {
    return axios({
        method: 'GET',
        url: getUrl() + '/api/v1/tracks',
        headers: {
            'Content-Type': 'application/json',
        },
    });
}

function create(data) {
    return axios({
        method: 'POST',
        url: getUrl() + '/api/v1/track',
        data: data,
        headers: {
            'Content-Type': 'application/json',
        },
    });
}

function del(id) {
    return axios({
        method: 'DELETE',
        url: getUrl() + '/api/v1/track/' + id,
        headers: {
            'Content-Type': 'application/json',
        },
    });
}

function getUrl() {
    return window.location.origin;
}