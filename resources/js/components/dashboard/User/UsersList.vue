<template>
<div class="table-responsive">
    <table class="table table-hover-animation">
      <thead>
        <tr>
          <th>Name</th>

          <th>Email</th>
            <th>Phone</th>

              <th>Created</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in users.data" :key="item.id">
          <td>
            <div class="d-flex align-items-center">

              <vue-letter-avatar
                :name="item.name"
                class="mr-75"
                size="40"
                :rounded="true"

              />
              <div>
                <div class="font-weight-bolder ml-2">{{ item.name }}</div>
              </div>
            </div>
          </td>


          <td>
              <span>{{item.email}}</span>
          </td>
        <td>
              <span>{{item.phone}}</span>
          </td>
          <!-- <td>
              <span>{{item.phone}}</span>
          </td> -->
            <td>
              <span>{{item.created_at | timeformat }}</span>
          </td>
          <td>
            <h5>
              <a
                v-b-tooltip.hover
                title="Edit"
                role="button"
                v-can="'UserUpdate'"
                @click="editData(item)"
                ><i class="fas fa-edit text-primary"></i
              >
              |
              </a>

              <a
                v-b-tooltip.hover
                title="Delete"
                role="button"
                v-can="'UserDelete'"
                @click="deleteData(item)"
                ><i class="fas fa-trash text-danger"></i
              ></a>
            </h5>
          </td>
        </tr>
      </tbody>
    </table>
    <hr />
    <div class="justify-content-center ml-4">
      <nav aria-label="Page navigation example">
        <ul class="pagination pagination-danger mt-2">
          <pagination
            :data="users"
            :limit="2"
            @pagination-change-page="getusers"
          ></pagination>
        </ul>
      </nav>
    </div>
  </div>
</template>

<script>
export default {
    props: ["users", "getusers","query"],
    methods: {
        deleteData: function (item) {
            return this.$emit("deleteData", item);
        },
        editData: function (item) {
            return this.$emit("editData", item);
        }
    }
}
</script>

<style>

</style>
