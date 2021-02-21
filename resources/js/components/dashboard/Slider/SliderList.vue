<template>
  <div class="table-responsive">
    <table class="table table-hover-animation">
      <thead>
        <tr>
          <th>Heading</th>
          <th>Sub Heading</th>
         <th>Link</th>
          <th>Position</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in sliders.data" :key="item.id">
          <td>
            <div class="d-flex align-items-center">

              <vue-letter-avatar
                :name="item.heading"
                class="mr-75"
                size="40"
                :rounded="true"

              />
              <div>
                <div class="font-weight-bolder ">{{ item.heading }}</div>
              </div>
            </div>
          </td>

          <td>
            <small>{{item.subheading}}</small>
          </td>
          <td>
            <span><a :href="item.link"></a>{{item.link}} </span>
          </td>
          <th> <span class="text-primary">{{item.sort}}</span></th>
          <td>
            <h5>
              <a
                v-b-tooltip.hover
                title="Edit"
                role="button"
                v-can="'AppSliderUpdate'"
                @click="editData(item)"
                ><i class="fas fa-edit text-primary"></i
              ></a>
              |
              <a
                v-b-tooltip.hover
                title="Delete"
                role="button"
                v-can="'AppSliderDelete'"
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
            :data="sliders"
            :limit="2"
            @pagination-change-page="getSlider"
          ></pagination>
        </ul>
      </nav>
    </div>
  </div>
</template>

<script>
export default {
  props: ["sliders", "getSlider", "query"],
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

