<script setup lang="ts">
import { Form, Head, setLayoutProps, usePage } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import PasswordInput from '@/components/PasswordInput.vue';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { useTranslations } from '@/composables/useTranslations';
import { wfArgs } from '@/lib/wayfinderArgs';
import { store } from '@/routes/password/confirm';

const page = usePage<{ locale: string; url_route_defaults: Record<string, string> }>();

const { t } = useTranslations();

setLayoutProps({
    title: t('website.auth.confirm_password.layout_title'),
    description: t('website.auth.confirm_password.layout_description'),
});
</script>

<template>
    <Head :title="t('website.auth.confirm_password.head_title')" />

    <Form
        v-bind="store.form(wfArgs(page))"
        reset-on-success
        v-slot="{ errors, processing }"
    >
        <div class="space-y-6">
            <div class="grid gap-2">
                <Label for="password">{{ t('website.auth.confirm_password.password_label') }}</Label>
                <PasswordInput
                    id="password"
                    name="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="current-password"
                    autofocus
                />

                <InputError :message="errors.password" />
            </div>

            <div class="flex items-center">
                <Button
                    class="w-full"
                    :disabled="processing"
                    data-test="confirm-password-button"
                >
                    <Spinner v-if="processing" />
                    {{ t('website.auth.confirm_password.submit') }}
                </Button>
            </div>
        </div>
    </Form>
</template>
