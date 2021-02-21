<template>
<div class="table-responsive">
    <table class="table table-hover-animation">
      <thead>
        <tr>
          <th>Name</th>
          <th>Users</th>
        <th>Created</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in roles.data" :key="item.id">
          <td>
            <div class="d-flex align-items-center">
              <div
                class="avatar rounded"
                v-if="(item.thumbnail != null) & (item.thumbnail != '')"
              >
                <div class="avatar-content">
                  <b-img-lazy
                    v-bind="mainProps"
                    :src="item.thumbnailurl"
                    rounded
                    alt=""
                  ></b-img-lazy>
                </div>
              </div>
              <vue-letter-avatar
                :name="item.name"
                class="mr-75"
                size="40"
                :rounded="true"
                v-else
              />
              <div>
                <div class="font-weight-bolder ml-2">{{ item.name }}</div>
              </div>
            </div>
          </td>




          <td>
              <span v-if="item.users!=null & item.users!=''">{{item.users.length}}</span>
          </td>
            <td>
              <span>{{item.created_at | timeformat }}</span>
          </td>
          <td>
            <h5>
              <a
                v-b-tooltip.hover
                title="Edit"
                role="button"
                v-can="'RoleUpdate'"
                @click="editData(item)"
                ><i class="fas fa-edit text-primary"></i
              > | </a>

              <a
                v-b-tooltip.hover
                title="Delete"
                role="button"
                v-can="'RoleDelete'"
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
            :data="roles"
            :limit="2"
            @pagination-change-page="getroles"
          ></pagination>
        </ul>
      </nav>
    </div>
  </div>
</template>

<script>
export default {
    props: ["roles", "getroles","query"],
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
