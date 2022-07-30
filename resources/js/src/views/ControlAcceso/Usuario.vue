<template>
    <div>
        <vx-card title="Usuarios">
            <div>
                <vs-button color="primary" type="filled" @click="popUsuarios"
                    >Agregar Nuevo Usuario</vs-button
                >
            </div>
            <br />
            <div>
                <vx-card>
                    <vue-good-table
                        :columns="columns"
                        :rows="rows"
                        :pagination-options="{
                            enabled: true,
                            perPage: 10
                        }"
                    >
                        <template slot="table-row" slot-scope="props">
                            <!-- Column: Name -->
                            <span
                                v-if="props.column.field === 'fullName'"
                                class="text-nowrap"
                            >
                            </span>
                            <span v-else-if="props.column.field === 'action'">
                                <plus-circle-icon
                                    content="Modificar Usuario"
                                    v-tippy
                                    size="1.5x"
                                    class="custom-class"
                                    @click="
                                        popModificarUsuario(
                                            props.row.id,
                                            props.row.run,
                                            props.row.nombre_usuario,
                                            props.row.apellido_usuario,
                                            props.row.anexo,
                                            props.row.correo_usuario
                                        )
                                    "
                                ></plus-circle-icon>
                            </span>
                            <!-- Column: Common -->
                            <span v-else>
                                {{ props.formattedRow[props.column.field] }}
                            </span>
                        </template>
                    </vue-good-table>
                </vx-card>
            </div>
            <vs-popup
                classContent="Usuarios"
                title="Agregar Usuario"
                :active.sync="popUpUsuario"
            >
                <div class="vx-col md:w-1/1 w-full mb-base">
                    <vx-card title="">
                        <div class="vx-row ">
                            <div class="vx-col w-1/2 mt-5">
                                <h6>Rut Usuario</h6>
                                <br />
                                <vs-input
                                    class="inputx w-full mb-6 "
                                    placeholder="Ej. 18499714-2"
                                    v-model="run_usuario"
                                    v-on:blur="formatear_run"
                                />
                                <span
                                    style="font-size: 10px; color: red; margin-left: 10px;"
                                    v-if="val_run"
                                    >Run incorrecto</span
                                >
                            </div>
                            <div class="vx-col w-1/2 mt-5">
                                <h6>Nombre</h6>
                                <br />
                                <vs-input
                                    class="inputx w-full mb-6 "
                                    placeholder="Ej. Ricardo"
                                    v-model="nombre_usuario"
                                />
                            </div>
                        </div>
                        <div class="vx-row">
                            <div class="vx-col w-1/2 mt-5">
                                <h6>Apellido</h6>
                                <br />
                                <vs-input
                                    class="inputx w-full mb-6 "
                                    placeholder="Ej. Soto"
                                    v-model="apellido_usuario"
                                />
                            </div>
                            <div class="vx-col w-1/2 mt-5">
                                <h6>Anexo</h6>
                                <br />
                                <vs-input
                                    class="inputx w-full mb-6 "
                                    placeholder="Ej. 222222"
                                    v-model="anexo"
                                />
                            </div>
                            <div class="vx-col w-1/2 mt-5">
                                <h6>Correo</h6>
                                <br />
                                <vs-input
                                    class="inputx w-full mb-6 "
                                    placeholder="Ej. ricardoarturo.soto@redsalud.gob.cl"
                                    v-model="correo_usuario"
                                />
                            </div>
                            <div class="vx-col w-1/2 mt-5">
                                <h6>Contraseña</h6>
                                <br />
                                <vs-input
                                    class="inputx w-full mb-6 "
                                    placeholder=""
                                    v-model="password"
                                    type="password"
                                />
                            </div>
                            <div class="vx-col w-full mt-5">
                                <h6>Servicio</h6>
                                <br />
                                <v-select
                                    taggable
                                    v-model="seleccionServicio"
                                    placeholder="Servicio"
                                    class="w-full select-large"
                                    label="descripcionServicio"
                                    :options="listadoServicios"
                                ></v-select>
                            </div>
                        </div>

                        <div class="vx-row">
                            <div class="vx-col w-1/2 mt-5">
                                <vs-button
                                    @click="popUpUsuario = false"
                                    color="primary"
                                    type="filled"
                                    class="w-full m-1"
                                    >Volver</vs-button
                                >
                            </div>
                            <div class="vx-col w-1/2 mt-5">
                                <vs-button
                                    @click="AgregarUsuario"
                                    color="danger"
                                    type="filled"
                                    class="w-full m-1"
                                    >Agregar Usuario</vs-button
                                >
                            </div>
                        </div>
                    </vx-card>
                    <div class="vx-row"></div>
                </div>
            </vs-popup>
            <vs-popup
                classContent="Usuarios"
                title="Modificar Usuario"
                :active.sync="popUpUsuarioMod"
            >
                <div class="vx-col md:w-1/1 w-full mb-base">
                    <vx-card title="">
                        <div class="vx-row ">
                            <div class="vx-col w-1/2 mt-5">
                                <h6>Rut Usuario</h6>
                                <br />
                                <vs-input
                                    class="inputx w-full mb-6 "
                                    placeholder="Ej. 18499714-2"
                                    v-model="run_usuario"
                                    v-on:blur="formatear_run"
                                />
                                <span
                                    style="font-size: 10px; color: red; margin-left: 10px;"
                                    v-if="val_run"
                                    >Run incorrecto</span
                                >
                            </div>
                            <div class="vx-col w-1/2 mt-5">
                                <h6>Nombre</h6>
                                <br />
                                <vs-input
                                    class="inputx w-full mb-6 "
                                    placeholder="Ej. Ricardo"
                                    v-model="nombre_usuario"
                                />
                            </div>
                        </div>
                        <div class="vx-row">
                            <div class="vx-col w-1/2 mt-5">
                                <h6>Apellido</h6>
                                <br />
                                <vs-input
                                    class="inputx w-full mb-6 "
                                    placeholder="Ej. Soto"
                                    v-model="apellido_usuario"
                                />
                            </div>
                            <div class="vx-col w-1/2 mt-5">
                                <h6>Anexo</h6>
                                <br />
                                <vs-input
                                    class="inputx w-full mb-6 "
                                    placeholder="Ej. 222222"
                                    v-model="anexo"
                                />
                            </div>
                            <div class="vx-col w-1/2 mt-5">
                                <h6>Correo</h6>
                                <br />
                                <vs-input
                                    class="inputx w-full mb-6 "
                                    placeholder="Ej. ricardoarturo.soto@redsalud.gob.cl"
                                    v-model="correo_usuario"
                                />
                            </div>
                            <div class="vx-col w-1/2 mt-5">
                                <h6>Contraseña</h6>
                                <br />
                                <vs-input
                                    class="inputx w-full mb-6 "
                                    placeholder=""
                                    v-model="password"
                                    type="password"
                                />
                            </div>
                            <div class="vx-col w-full mt-5">
                                <h6>Servicio</h6>
                                <br />
                                <v-select
                                    taggable
                                    v-model="seleccionServicio"
                                    placeholder="Servicio"
                                    class="w-full select-large"
                                    label="descripcionServicio"
                                    :options="listadoServicios"
                                ></v-select>
                            </div>
                        </div>

                        <div class="vx-row">
                            <div class="vx-col w-1/2 mt-5">
                                <vs-button
                                    @click="popUpUsuarioMod = false"
                                    color="primary"
                                    type="filled"
                                    class="w-full m-1"
                                    >Volver</vs-button
                                >
                            </div>
                            <div class="vx-col w-1/2 mt-5">
                                <vs-button
                                    @click="ModificarUsuario"
                                    color="danger"
                                    type="filled"
                                    class="w-full m-1"
                                    >Modificar Usuario</vs-button
                                >
                            </div>
                        </div>
                    </vx-card>
                    <div class="vx-row"></div>
                </div>
            </vs-popup>
        </vx-card>
    </div>
</template>
<script>
import axios from "axios";
import router from "@/router";
import vSelect from "vue-select";
import "quill/dist/quill.core.css";
import "quill/dist/quill.snow.css";
import "quill/dist/quill.bubble.css";
import { quillEditor } from "vue-quill-editor";
import "vue-good-table/dist/vue-good-table.css";
import { VueGoodTable } from "vue-good-table";
import { PlusCircleIcon } from "vue-feather-icons";
import { validate, clean, format } from "rut.js";
import Vue from "vue";
import VueTippy, { TippyComponent } from "vue-tippy";
Vue.use(VueTippy);
Vue.component("tippy", TippyComponent);

export default {
    components: {
        VueGoodTable,
        "v-select": vSelect,
        quillEditor,
        PlusCircleIcon
    },
    data() {
        return {
            //Datos Locales - Variables de Entorno
            localVal: process.env.MIX_APP_URL,
            editorOption: {
                modules: {
                    toolbar: [
                        ["bold", "italic", "underline", "strike"],
                        ["blockquote", "code-block"],
                        [{ header: 1 }, { header: 2 }],
                        [{ list: "ordered" }, { list: "bullet" }],
                        [{ indent: "-1" }, { indent: "+1" }],
                        [{ direction: "rtl" }],
                        [{ font: [] }],
                        [{ align: [] }],
                        ["clean"]
                    ]
                }
            },
            //Datos Campos
            popUpUsuario: false,
            popUpUsuarioMod: false,
            run_usuario: "",
            nombre_usuario: "",
            apellido_usuario: "",
            anexo: "",
            correo_usuario: "",
            password: "",
            idMod: 0,
            idServicio: 0,
            val_run: false,
            seleccionServicio: {
                id: 0,
                descripcionServicio: ""
            },
            //Template Columnas Listado Proveedor
            columns: [
                {
                    label: "Rut",
                    field: "run",
                    filterOptions: {
                        enabled: true
                    }
                },
                {
                    label: "Nombre",
                    field: "nombre_usuario",
                    filterOptions: {
                        enabled: true
                    }
                },
                {
                    label: "Apellido",
                    field: "apellido_usuario",
                    filterOptions: {
                        enabled: true
                    }
                },
                {
                    label: "Anexo",
                    field: "anexo",
                    filterOptions: {
                        enabled: true
                    }
                },
                {
                    label: "Servicio",
                    field: "descripcionServicio",
                    filterOptions: {
                        enabled: true
                    }
                },
                {
                    label: "Opciones",
                    field: "action"
                }
            ],
            //Datos Listado Proveedor
            rows: [],
            listadoServicios: []
        };
    },
    methods: {
        //Metodos Reusables
        openLoadingColor() {
            this.$vs.loading({ color: this.colorLoading });
            setTimeout(() => {
                this.$vs.loading.close();
            }, 1000);
        },
        isNumber: function(evt) {
            evt = evt ? evt : window.event;
            var charCode = evt.which ? evt.which : evt.keyCode;
            if (
                charCode > 31 &&
                (charCode < 48 || charCode > 57) &&
                charCode !== 46
            ) {
                evt.preventDefault();
            } else {
                return true;
            }
        },
        formatear_run() {
            if (this.run_usuario == "" || this.run_usuario == null) {
                //console.log("Sin Rut");
                this.val_run = false;
            } else {
                this.run_usuario = format(this.run_usuario);
                this.val_run = !validate(this.run_usuario);
            }
        },
        limpiarCampos() {
            try {
                this.run_usuario = "";
                this.nombre_usuario = "";
                this.apellido_usuario = "";
                this.anexo = "";
                this.correo_usuario = "";
                this.password = "";
            } catch (error) {
                console.log(error);
            }
        },
        //PopUp
        popUsuarios() {
            try {
                this.popUpUsuario = true;
            } catch (error) {
                console.log(error);
            }
        },
        popModificarUsuario(id, rut, nombre, apellido, anexo, correo) {
            try {
                this.run_usuario = rut;
                this.nombre_usuario = nombre;
                this.apellido_usuario = apellido;
                this.anexo = anexo;
                this.correo_usuario = correo;
                this.idMod = id;
                this.popUpUsuarioMod = true;
            } catch (error) {
                console.log(error);
            }
        },
        //Carga de Datos
        TraerServicio() {
            try {
                axios
                    .get(this.localVal + "/api/Servicios/GetServicios", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoServicios = res.data;
                        if (this.listadoServicios.length < 0) {
                            this.$vs.notify({
                                time: 5000,
                                title: "Error",
                                text:
                                    "No hay datos o no se cargaron los datos de los servicios correctamente",
                                color: "danger",
                                position: "top-right"
                            });
                        }
                    });
            } catch (error) {
                console.log(error);
            }
        },
        TraerUsuarios() {
            try {
                axios
                    .get(this.localVal + "/api/Usuarios/GetUsers", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.rows = res.data;
                        if (this.rows.length < 0) {
                            this.$vs.notify({
                                time: 5000,
                                title: "Error",
                                text:
                                    "No hay datos o no se cargaron los datos de los servicios correctamente",
                                color: "danger",
                                position: "top-right"
                            });
                        }
                    });
            } catch (error) {
                console.log(error);
            }
        },
        //Metodos para Agregar Datos
        AgregarUsuario() {
            try {
                if (this.run_usuario == "" || this.run_usuario == null) {
                    this.$vs.notify({
                        time: 5000,
                        title: "Error",
                        text: "Debe ingresar un rut de usuario",
                        color: "danger",
                        position: "top-right"
                    });
                } else if (
                    this.correo_usuario == "" ||
                    this.correo_usuario == null
                ) {
                    this.$vs.notify({
                        time: 5000,
                        title: "Error",
                        text: "Debe ingresar un correo del usuario",
                        color: "danger",
                        position: "top-right"
                    });
                } else if (
                    this.nombre_usuario == "" ||
                    this.nombre_usuario == null
                ) {
                    this.$vs.notify({
                        time: 5000,
                        title: "Error",
                        text: "Debe ingresar un nombre",
                        color: "danger",
                        position: "top-right"
                    });
                } else if (
                    this.apellido_usuario == "" ||
                    this.apellido_usuario == null
                ) {
                    this.$vs.notify({
                        time: 5000,
                        title: "Error",
                        text: "Debe ingresar un apellido",
                        color: "danger",
                        position: "top-right"
                    });
                } else if (this.anexo == 0) {
                    this.$vs.notify({
                        time: 5000,
                        title: "Error",
                        text: "Debe ingresar un anexo",
                        color: "danger",
                        position: "top-right"
                    });
                } else if (this.password == "" || this.password == null) {
                    this.$vs.notify({
                        time: 5000,
                        title: "Error",
                        text: "Debe ingresar una contraseña",
                        color: "danger",
                        position: "top-right"
                    });
                } else if (this.seleccionServicio.id == 0) {
                    this.$vs.notify({
                        time: 5000,
                        title: "Error",
                        text: "Debe seleccionar un servicio",
                        color: "danger",
                        position: "top-right"
                    });
                } else {
                    let data = {
                        run_usuario: this.run_usuario,
                        correo_usuario: this.correo_usuario.toUpperCase(),
                        nombre_usuario: this.nombre_usuario.toUpperCase(),
                        apellido_usuario: this.apellido_usuario.toUpperCase(),
                        anexo: this.anexo,
                        password: this.password,
                        idServicio: this.seleccionServicio.id,
                        idAplicacion: 1,
                        idAccesoUsuario: 1,
                        permiso_usuario: 1,
                        estado_login: 1
                    };

                    const dat = data;

                    axios
                        .post(
                            this.localVal + "/api/Usuarios/RegistrarUsuario",
                            dat,
                            {
                                headers: {
                                    Authorization:
                                        `Bearer ` +
                                        sessionStorage.getItem("token")
                                }
                            }
                        )
                        .then(res => {
                            const solicitudServer = res.data;
                            if (solicitudServer == true) {
                                this.limpiarCampos();
                                this.$vs.notify({
                                    time: 5000,
                                    title: "Completado",
                                    text: "Usuario Registrado Correctamente",
                                    color: "success",
                                    position: "top-right"
                                });
                                this.popUpUsuario = false;
                                this.TraerUsuarios();
                            } else {
                                this.$vs.notify({
                                    time: 5000,
                                    title: "Error",
                                    text:
                                        "No fue posible registrar al usuario,intentelo nuevamente",
                                    color: "danger",
                                    position: "top-right"
                                });
                            }
                        });
                }
            } catch (error) {
                console.log(error);
            }
        },
        ModificarUsuario() {
            try {
                if (this.run_usuario == "" || this.run_usuario == null) {
                    this.$vs.notify({
                        time: 5000,
                        title: "Error",
                        text: "Debe ingresar un rut de usuario",
                        color: "danger",
                        position: "top-right"
                    });
                } else if (
                    this.correo_usuario == "" ||
                    this.correo_usuario == null
                ) {
                    this.$vs.notify({
                        time: 5000,
                        title: "Error",
                        text: "Debe ingresar un correo del usuario",
                        color: "danger",
                        position: "top-right"
                    });
                } else if (
                    this.nombre_usuario == "" ||
                    this.nombre_usuario == null
                ) {
                    this.$vs.notify({
                        time: 5000,
                        title: "Error",
                        text: "Debe ingresar un nombre",
                        color: "danger",
                        position: "top-right"
                    });
                } else if (
                    this.apellido_usuario == "" ||
                    this.apellido_usuario == null
                ) {
                    this.$vs.notify({
                        time: 5000,
                        title: "Error",
                        text: "Debe ingresar un apellido",
                        color: "danger",
                        position: "top-right"
                    });
                } else if (this.anexo == 0) {
                    this.$vs.notify({
                        time: 5000,
                        title: "Error",
                        text: "Debe ingresar un anexo",
                        color: "danger",
                        position: "top-right"
                    });
                } else if (this.password == "" || this.password == null) {
                    this.$vs.notify({
                        time: 5000,
                        title: "Error",
                        text: "Debe ingresar una contraseña",
                        color: "danger",
                        position: "top-right"
                    });
                } else if (this.seleccionServicio.id == 0) {
                    this.$vs.notify({
                        time: 5000,
                        title: "Error",
                        text: "Debe seleccionar un servicio",
                        color: "danger",
                        position: "top-right"
                    });
                } else {
                    let data = {
                        id: this.idMod,
                        run_usuario: this.run_usuario,
                        correo_usuario: this.correo_usuario.toUpperCase(),
                        nombre_usuario: this.nombre_usuario.toUpperCase(),
                        apellido_usuario: this.apellido_usuario.toUpperCase(),
                        idServicio: this.seleccionServicio.id,
                        anexo: this.anexo,
                        password: this.password,
                        idAplicacion: 1,
                        idAccesoUsuario: 1,
                        estado_login: 1
                    };

                    const dat = data;

                    axios
                        .post(this.localVal + "/api/Usuarios/PutUsuario", dat, {
                            headers: {
                                Authorization:
                                    `Bearer ` + sessionStorage.getItem("token")
                            }
                        })
                        .then(res => {
                            const solicitudServer = res.data;
                            if (solicitudServer == true) {
                                this.limpiarCampos();
                                this.$vs.notify({
                                    time: 5000,
                                    title: "Completado",
                                    text: "Usuario Modificado Correctamente",
                                    color: "success",
                                    position: "top-right"
                                });
                                this.popUpUsuarioMod = false;
                                this.TraerUsuarios();
                            } else {
                                this.$vs.notify({
                                    time: 5000,
                                    title: "Error",
                                    text:
                                        "No fue posible modificar al usuario,intentelo nuevamente",
                                    color: "danger",
                                    position: "top-right"
                                });
                            }
                        });
                }
            } catch (error) {
                console.log(error);
            }
        }
    },
    beforeMount() {
        setTimeout(() => {
            this.TraerServicio();
            this.TraerUsuarios();
            this.openLoadingColor();
        }, 2000);
    }
};
</script>
<style lang="stylus">
.con-vs-popup .vs-popup {
  width: 1000px;
}
</style>
