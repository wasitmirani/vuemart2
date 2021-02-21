<template>
  <div>
    <Breadcrumb
      homeName="Dashboard"
      homeUrl="/"
      activeName="Roles"
      :breadcrumbbar="true"
    ></Breadcrumb>


    <!--/ Miscellaneous Charts -->

    <!-- Table Hover Animation start -->
    <div class="row" id="table-hover-animation">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title" v-can="'RolesRead'">Roles List</h4>
          </div>
          <div class="card-body">
            <div class="card-text row">
              <div class="col-md-10 col-sm-6 col-xs-8">
                <div class="col-md-4">
                  <SearchInput
                    :apiurl="'role?page=' + this.pageNum"
                     v-can="'RolesRead'"
                    v-on:query="isquery($event)"
                    v-on:isLoading="isLoadingStart($event)"
                    v-on:reload="getroles()"
                    v-on:dataList="searchData($event)"
                    label="Search roles"
                  ></SearchInput>
                </div>
              </div>

              <div class="col-md-2 col-sm-6 col-xs-4">
                <button
                  type="button"

                   v-can="'RoleCreate'"
                  class=".btn-sm btn-primary form-control"
                  @click="openPopup"
                  style="height: auto"
                >

                  New Role
                </button>
              </div>
            </div>
          </div>
          <b-overlay :show="isLoading" variants="transparent" rounded="md" v-can="'RolesRead'">
            <RolesList
              :roles="this.roles"
              :query="query"
                v-can="'RolesRead'"
              :getroles="getroles"
              v-on:editData="editData($event)"
              v-on:deleteData="deleteData($event)"
            ></RolesList>
          </b-overlay>

          <!-- Table -->
        </div>
      </div>
    </div>
    <!-- Table head options end -->
    <!-- Modal -->
    <div
      class="modal fade text-left"
      id="modal_id"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myModalLabel17"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" v-if="!editMode">Create New Role</h4>
            <h4 class="modal-title" v-else>Update Role</h4>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <RoleForm
              :editMode="editMode"
              :editForm="editCollection"
              v-can="'RoleCreate'"
               :users="this.users"
              v-on:created="closePopup($event)"
              v-on:updated="closePopup($event)"
            ></RoleForm>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Breadcrumb from "../Breadcrumb/BreadcrumbComponent";
import RolesList from "./RolesList";
import SearchInput from "../Search/SearchFilterComponent";
import RoleForm from "./RoleForm";
export default {
  components: {
    Breadcrumb,
    RolesList,
    SearchInput,
    RoleForm,
  },
  data() {
    return {
      roles: {},
      users:[],
      staticList: {
        active: 0,
        total: 0,
        disable: 0,
        trashed: 0,
      },
      isLoading: false,
      pageNum: 1,
      query: "",
      editMode: false,
      editCollection: {},
    };
  },
  methods: {
    isLoadingStart(value) {
      this.isLoading = value;
    },
    openPopup() {
      this.editMode = false;
      this.editCollection = null;
      $("#modal_id").modal("show");
    },
    closePopup(item) {
      if (item) {
        this.getroles();
        $("#modal_id").modal("hide");
      }
    },
    isquery(query) {
      return (this.query = query);
    },
    editData(item) {
      this.editMode = true;
      this.editCollection = item;
      $("#modal_id").modal("show");
    },
    searchData(data) {
      this.roles = data.roles;
    },
    getroles(page = 1) {
      this.isLoading = true;
      this.page_num = page;
      axios
        .get(
          this.$hostapi_url + "/role?page=" + page + "&query=" + this.query,
          this.$config
        )
        .then((res) => {
          this.roles = res.data.roles;
          this.users=res.data.users;
          this.staticList.active = res.data.active;
          this.staticList.total = res.data.total;
          this.staticList.disable = res.data.disable;
          this.staticList.trashed = res.data.trashed;
          this.isLoading = false;
        })
        .catch((er) => {
          //   console.log(er.response.data.errors);
        });
    },

    deleteData(item) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .delete(this.$hostapi_url + "/role/" + item.id, this.$config)
            .then((res) => {
              this.getroles();
              Swal.fire("Deleted!", "Your file has been deleted.", "success");
            });
        }
      });
    },
  },
  mounted() {
    this.getroles();
  },
};
</script>

<style>
</style>
