<template>
  <div class="table-responsive">
    <table class="table table-hover-animation">
      <thead>
        <tr>
          <th>Page Title</th>
          <th>Page URL</th>
            <th>Meta Description</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in seo.data" :key="item.id">
          <td>

               <div class="d-flex align-items-center">

              <vue-letter-avatar
                :name="item.page_title"

                size="40"
                :rounded="true"

              />



            </div>
              <div class="font-weight-bolder ">{{ item.page_title }}</div>

          </td>
          <td>
            <span>{{item.page_url}}</span>
          </td>
           <td>
            <span>{{item.meta_description}}</span>
          </td>
          <td>
            <h5>
              <a
                v-b-tooltip.hover
                title="Edit"
                 v-can="'SeoUpdate'"
                role="button"
                @click="editData(item)"

                ><i class="fas fa-edit text-primary"></i
              ></a>
              |
              <a
                v-b-tooltip.hover
                title="Delete"
                v-can="'SeoDelete'"
                role="button"
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
            :data="seo"
            :limit="2"
            @pagination-change-page="getseo"
          ></pagination>
        </ul>
      </nav>
    </div>
  </div>
</template>

<script>
export default {
  props: ["seo", "getseo", "query"],
  data() {
    return {
      mainProps: {
        blank: false,
        blankColor: "#777",
        width: 60,
        height: 60,
        class: "m1",
      },
    };
  },
  methods: {
    deleteData: function (item) {
      return this.$emit("deleteData", item);
    },
    editData: function (item) {
      return this.$emit("editData", item);
    },
  },
};
</script>
