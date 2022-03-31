<template> 
    <div class="items"> 
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div v-if="errors.length">
                        <div v-for="error in errors" :key="error.index" class="alert alert-danger mt-1" role="alert">
                            {{ error }}
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            EDIT ITEMS
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="ItemUpdate">

                                <div class="form-group">
                                    <label>Nama Item</label>
                                    <input type="text" class="form-control" v-model="item.nama_item"
                                        placeholder="Masukkan Nama Item">
                                </div>

                                <div class="form-group">
                                    <label>Unit</label>
                                    <input type="text" class="form-control" v-model="item.unit"
                                        placeholder="Masukkan Unit">
                                </div>

                                <div class="form-group">
                                    <label>Stok</label>
                                    <input type="text" class="form-control" v-model="item.stok"
                                        placeholder="Masukkan Stok">
                                </div>

                                <div class="form-group">
                                    <label>Harga Satuan</label>
                                    <input type="text" class="form-control" v-model="item.harga_satuan"
                                        placeholder="Masukkan Harga Satuan">
                                </div>
                                
                                <div class="form-group">
                                    <label>Barang</label>
                                    <input type="text" class="form-control" v-model="item.barang"
                                        placeholder="Masukkan Harga Satuan">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-md btn-success mr-2">UPDATE</button>
                                    <button type="reset" class="btn btn-md btn-danger">RESET</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template> 

<script> 
 import axios from 'axios'

    export default {
        data() {
            return {
                item: {},
                errors: []
            }
        },
        created() {
            axios.get(`http://localhost:8080/api/item/${this.$route.params.id}`)
                .then((response) => {
                    this.item = response.data.data;
                });
        },
        methods: {
            ItemUpdate(e) {

                if (this.item.nama_item && this.item.unit && this.item.stok && this.item.harga_satuan && this.item.barangt) {
                    axios.put(`http://localhost:8080/api/post/${this.$route.params.id}`, this.item)
                        .then((response) => {
                            this.$router.push({
                                name: 'items'
                            });
                            console.log(response);
                        }).catch(error => {
                            console.log(error.response.data.data);
                        });
                }

                this.errors = [];

                 if (!this.item.nama_item) {
                    this.errors.push('Masukkan Nama Item.');
                }

                if (!this.item.unit) {
                    this.errors.push('Masukkan Unit Item.');
                }

                if (!this.item.stok) {
                    this.errors.push('Masukkan Stok Item.');
                }

                if (!this.item.harga_satuan) {
                    this.errors.push('Masukkan Harga Satuan Item.');
                }

                if (!this.item.barang) {
                    this.errors.push('Masukkan Barang Item.');
                }

                e.preventDefault()
            }
        }
    }
</script>
