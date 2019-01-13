<template>
    <b-container>
        <b-button @click="addAlbum" class="mt-5">Add Album</b-button>
        <b-button variant="danger" @click="deleteMode" class="mt-5">Delete Album</b-button>

        <b-list-group class="mt-5">
            <b-list-group-item href="#" v-for="(album, index) in albums" :key="album.no" @click="albumDetail(index)" class="d-flex justify-content-between align-items-center">
                <div>
                    <img v-bind:src="album.cover_image" class="album-img" />
                    {{ album.name }}
                </div>
                <div>
                    <transition name="slide-fade">
                        <b-badge v-if="mode == '' && album.songs.length > 0" variant="primary" pill>{{ album.songs.length }}</b-badge>
                    </transition>
                    <transition name="slide-fade">
                        <b-badge v-if="mode == 'delete'" variant="danger" pill @click="deleteAlbumConfirm(index)"> X </b-badge>
                    </transition>
                </div>
            </b-list-group-item>
        </b-list-group>

        <b-modal v-model="show" size="lg"
                 title="Album detail">
            <b-container fluid>
                <b-row class="my-1">
                    <b-col sm="3"><label>Album title</label></b-col>
                    <b-col sm="9"><b-input v-model="modalTitle" :value="modalTitle" /></b-col>
                </b-row>
                <b-row class="my-1">
                    <b-col sm="3"><label>Cover Image</label></b-col>
                    <b-col sm="9"><b-input v-model="modalImg" :value="modalImg "/></b-col>
                </b-row>
                <hr />
                <div v-for="(song, index) in modalSongs">
                    <b-row class="my-1">
                        <b-col sm="3"><label>- artist</label></b-col>
                        <b-col sm="9"><b-input v-model="song.artist" :value="song.artist" /></b-col>
                    </b-row>
                    <b-row class="my-1">
                        <b-col sm="3"><label>- title</label></b-col>
                        <b-col sm="9"><b-input v-model="song.title" :value="song.title" /></b-col>
                    </b-row>
                    <b-row class="my-1">
                        <b-col sm="3"><label>- image</label></b-col>
                        <b-col sm="9"><b-input v-model="song.image" :value="song.image" /></b-col>
                    </b-row>
                    <b-row class="my-1">
                        <b-col sm="3"><label>- url</label></b-col>
                        <b-col sm="9"><b-input v-model="song.url" :value="song.url" /></b-col>
                    </b-row>
                    <div class="clearfix">
                        <div class="float-right">
                            <b-btn class="" size="sm" variant="danger" @click="deleteSong(index, song.id)">
                                Delete Song
                            </b-btn>
                        </div>
                    </div>
                    <hr v-if="index < modalSongs.length - 1" />
                </div>
            </b-container>
            <div slot="modal-footer" class="w-100">
                <div class="float-left">
                    <b-btn class="" variant="primary" @click="addSong">
                        Add song
                    </b-btn>
                </div>
                <div class="float-right">
                    <b-btn class="" @click="show=false">
                        Close
                    </b-btn>
                    <b-btn class="" variant="primary" @click="saveAlbum">
                        Save
                    </b-btn>
                </div>
            </div>
        </b-modal>

        <b-modal v-model="deleteModal" size="" centered hide-footer hide-header>
            <div class="d-block text-center">
                <h3>Are you sure?</h3>
                <p class="my-4">Do you want to remove this album?</p>
            </div>
            <div class="d-block text-center">
                <b-button @click="deleteModal = !deleteModal" size="sm">Cancel</b-button>
                <b-button @click="deleteAlbum" variant="danger" size="sm">DELETE</b-button>
            </div>
        </b-modal>
    </b-container>
</template>

<script>
    export default {
        data () {
            return {
                show: false,
                deleteModal: false,
                mode: '',
                thisAlbumIndex: -1,
                modalTitle: '',
                modalImg: '',
                modalSongs: [
                ],
                modalDeleteSongs: [],
                albums: [
                ],
            }
        },
        methods: {
            addAlbum: function() {
                var self = this;

                axios({
                    method: 'POST',
                    url: '/api/sucol/artist/album',
                })
                    .then(function (response) {
                        console.log(response);

                        self.albums = response.data;
                    });
            },
            deleteMode: function() {
                if (this.mode === '') this.mode = 'delete';
                else this.mode = '';
            },
            deleteAlbumConfirm: function(index) {
                this.thisAlbumIndex = index;

                this.deleteModal = !this.deleteModal;
            },
            deleteAlbum: function() {
                var self = this;
                var index = this.thisAlbumIndex;

                axios({
                    method: 'DELETE',
                    url: '/api/sucol/artist/album',
                    data: {
                        id: this.albums[index].no,
                    }
                }).then(function (response) {
                    console.log(response);

                    self.albums = response.data;
                    self.deleteModal = !self.deleteModal;
                });
            },
            addSong: function() {
                this.modalSongs.push({
                    id: 'new',
                    artist: '',
                    title: '',
                    image: '',
                    url: '',
                });
            },
            deleteSong: function(index, id) {
                this.modalDeleteSongs.push(id);
                this.modalSongs.splice(index, 1)
            },
            saveAlbum: function() {
                var self = this;
                var index = this.thisAlbumIndex;

                axios({
                    method: 'PUT',
                    url: '/api/sucol/artist/album',
                    data: {
                        id: this.albums[index].no,
                        title: this.modalTitle,
                        img: this.modalImg,
                        songs: this.modalSongs,
                        deletesongs: this.modalDeleteSongs,
                    },
                }).then(function (response) {
                    console.log(response);

                    self.albums = response.data;
                });

                this.show = false
            },
            albumDetail: function(index) {
                if (this.mode !== '') {
                    return false;
                }

                this.thisAlbumIndex = index;
                this.modalTitle = this.albums[index].name;
                this.modalImg = this.albums[index].cover_image;
                this.modalSongs = JSON.parse(JSON.stringify(this.albums[index].songs));
                this.modalDeleteSongs = [];

                this.show = true
            },
            getAlbums: function() {
                var self = this;

                axios({
                    method: 'POST',
                    url: '/api/sucol/artist/albums',
                })
                    .then(function (response) {
                        console.log(response);

                        self.albums = response.data;
                    });
            }
        },
        mounted() {
            this.getAlbums();
        }
    }
</script>

<style scoped>
    .album-img {
        margin: 0 15px 0 0;
        width: 80px;
        height: 80px;
    }
    .slide-fade-enter-active {
        transition: all .3s ease;
    }
    .slide-fade-leave-active {
        display: none;
    }
    .slide-fade-enter {
        transform: translateX(10px);
        opacity: 0;
    }
</style>