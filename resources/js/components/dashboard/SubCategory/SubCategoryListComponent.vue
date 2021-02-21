<template>
  <div class="table-responsive">
    <table class="table table-hover-animation">
      <thead>
        <tr>
          <th>Name</th>

          <th>Category</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in subCategories.data" :key="item.id">
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
                <!-- <div class="font-small-2 text-muted">meguc@ruj.io</div> -->
              </div>
            </div>
          </td>

          <td>
            <div
              class="avatar-group"
              v-if="(item.category != null) & (item.category != '')"
            >
              <b-img-lazy
                v-bind="mainProps"
                :src="item.category.thumbnailurl"
                rounded
                alt=""
                v-if="
                  (item.category.thumbnail != null) &
                  (item.category.thumbnail != '')
                "
              ></b-img-lazy>
              <vue-letter-avatar
                :name="item.category.name"
                class="mr-75"
                size="30"
                :rounded="true"
                v-else
              />
              <span
                class="font-weight-bold ml-1 mt-2"
                style="margin-top: 6px"
                >{{ item.category.name }}</span
              >
            </div>
          </td>
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
            :data="subCategories"
            :limit="2"
            @pagination-change-page="getSubCategories"
          ></pagination>
        </ul>
      </nav>
    </div>
  </div>
</template>

<script>
export default {
  props: ["subCategories", "getSubCategories", "query"],
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

