<template>
  <div class="items">
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">ITEMS</div>
            <div class="card-body">
              <router-link :class="['btn btn-success mb-2']" to="/create">Add New Item</router-link>
              <hr>

              <div class="table-responsive mt-2">
                <table class="table table-hover table-bordered">
                  <thead>
                    <tr>
                      <th>Nama Item</th>
                      <th>Unit</th>
                      <th>Stok</th>
                      <th>Harga Satuan</th>
                      <th>Barang</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(item, index) in items" :key="item.id">
                      <td>{{ item.title }}</td>
                      <td>{{ item.nama_item }}</td>
                      <td>{{ item.unit }}</td>
                      <td>{{ item.stok }}</td>
                      <td>{{ item.harga_satuan }}</td>
                      <td>{{ item.barang }}</td>
                      <td class="text-center">
                        <router-link :to="{ name: 'edit', params: { id: item.id } }" class="btn btn-sm btn-warning mr-2">Edit</router-link>
                        <button @click.prevent="ItemDelete(item.id, index)" class="btn btn-sm btn-danger">Delete</button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
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
                items: []
            }
        },
        created() {
            axios.get('http://localhost:8080/api/item').then(response => {
                this.items = response.data.data;
            });
        },
        methods: {
            ItemDelete(id, index)
            {
                axios.delete(`http://localhost:8080/api/item/${id}`)
                    .then(response => {
                        this.item.splice(index, 1);
                        console.log(response);
                    }).catch(error => {
                    console.log(error.response);
                });
            }
        }
    }
</script>
