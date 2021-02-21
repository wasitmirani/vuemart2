<template>
  <div class="table-responsive">
    <table class="table table-hover-animation">
      <thead>
        <tr>
          <th>Name</th>

          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in categories.data" :key="item.id">
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

          <!-- <td>
            <div class="avatar-group">
              <div
                data-toggle="tooltip"
                data-popup="tooltip-custom"
                data-placement="top"
                title=""
                class="avatar pull-up my-0"
                data-original-title="Lilian Nenez"
              >
                <img
                  src="app-assets\images\portrait\small\avatar-s-5.jpg"
                  alt="Avatar"
                  height="26"
                  width="26"
                />
              </div>
              <div
                data-toggle="tooltip"
                data-popup="tooltip-custom"
                data-placement="top"
                title=""
                class="avatar pull-up my-0"
                data-original-title="Alberto Glotzbach"
              >
                <img
                  src="app-assets\images\portrait\small\avatar-s-6.jpg"
                  alt="Avatar"
                  height="26"
                  width="26"
                />
              </div>
              <div
                data-toggle="tooltip"
                data-popup="tooltip-custom"
                data-placement="top"
                title=""
                class="avatar pull-up my-0"
                data-original-title="Alberto Glotzbach"
              >
                <img
                  src="app-assets\images\portrait\small\avatar-s-7.jpg"
                  alt="Avatar"
                  height="26"
                  width="26"
                />
              </div>
            </div>
          </td> -->
          <td>
            <p :inner-html.prop="item.status | categoryStatus"></p>
          </td>
          <td>
            <h5>
              <a
                v-b-tooltip.hover
                title="Edit"
                role="button"
                @click="editData(item)"
                ><i class="fas fa-edit text-primary"></i
              ></a>
              |
              <a
                v-b-tooltip.hover
                title="Delete"
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
            :data="categories"
            :limit="2"
            @pagination-change-page="getCategories"
          ></pagination>
        </ul>
      </nav>
    </div>
  </div>
</template>

<script>
export default {
  props: ["categories", "getCategories", "query"],
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

