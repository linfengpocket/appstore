<template>
    <el-dialog title="群发消息设置" :visible.sync="showDialog" width="50%">
        <el-form :model="form" ref="form" label-width="100px" :inline="false" size="normal">
            <el-card shadow="nerver" :body-style="{ padding: '20px' }">
                <el-form-item label="群发消息描述">
                    <el-input v-model="form.title" />
                    <hd-form-error name="title" />
                </el-form-item>
                <el-form-item label="群发类型" size="normal">
                    <el-radio-group v-model="form.type" :disabled="!!form.id">
                        <el-radio v-for="type in types" :key="type.id" :label="type.id">
                            {{ type.label }}
                        </el-radio>
                    </el-radio-group>
                </el-form-item>
                <el-form-item label="转载处理" size="normal">
                    <el-radio-group v-model="form.content.send_ignore_reprint">
                        <el-radio :label="1">继续转发</el-radio>
                        <el-radio :label="0">禁止转发</el-radio>
                    </el-radio-group>
                    <hd-tip>图文消息被判定为转载时，是否继续群发</hd-tip>
                </el-form-item>
            </el-card>
            <el-card shadow="nerver" :body-style="{ padding: '20px' }" class="mt-3">
                <div slot="header">
                    <span>群发内容</span>
                </div>
                <div v-if="form.type != 'text'">
                    <hd-wechat-material-preview :material="material" v-if="material" />
                    <el-dialog title="选择素材" :visible.sync="materialDialogShow" width="60%" :append-to-body="true">
                        <hd-wechat-material :wechat="wechat" #default="{material}" :material-type="materialType" :show-type-button="false">
                            <el-button type="primary" size="mini" @click="selectMaterial(material)">选择</el-button>
                        </hd-wechat-material>
                    </el-dialog>
                    <el-button type="primary" size="mini" @click="materialDialogShow = true" class="mt-3 block">选择素材</el-button>
                </div>
                <div v-else>
                    <el-input type="textarea" v-model="form.content.text.content" placeholder="" size="normal" clearable></el-input>
                </div>
            </el-card>
        </el-form>
        <span slot="footer">
            <el-button type="primary" @click="onSubmit" :disabled="isSubmit" v-loading="isSubmit">保存提交</el-button>
        </span>
    </el-dialog>
</template>

<script>
import field from './field'
import types from './types'
export default {
    props: ['show', 'wechat', 'module', 'message'],
    data() {
        return {
            showDialog: this.show,
            isSubmit: false,
            form: null,
            materialDialogShow: false,
            types,
            //选择的素材
            material: null
        }
    },
    computed: {
        //素材类型
        materialType() {
            return this.types.find(t => t.id == this.form.type).mtype
        }
    },
    watch: {
        'form.type'(n) {
            this.form.content.msgtype = n
            this.material = null
        },
        //父组件传递消息
        message: {
            handler(message) {
                this.form = message ?? _.cloneDeep(field)
                this.material = message?.material
            },
            immediate: true
        },
        show(n) {
            this.showDialog = n
        },
        showDialog(n) {
            this.$emit('update:show', n)
        }
    },
    methods: {
        //保存提交
        async onSubmit() {
            this.isSubmit = true
            this.form.module_id = this.module ?? null
            const url = `site/${this.wechat.site_id}/wechat/${this.wechat.id}/sendall/message/` + (this.form.id ? this.form.id : '')
            try {
                await axios[this.form.id ? 'put' : 'post'](url, this.form)
                this.showDialog = false
                this.$parent.load()
            } finally {
                this.isSubmit = false
            }
        },
        //选择素材
        selectMaterial(material) {
            this.form.material_id = material.id
            this.material = material
            this.materialDialogShow = false
            //设置群发消息media_id
            if (this.form.type == 'images') {
                this.form.content[this.form.type].media_ids = [material.id]
            } else {
                this.form.content[this.form.type].media_id = material.response.media_id
            }
        }
    }
}
</script>

<style></style>
