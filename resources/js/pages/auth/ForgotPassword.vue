<script setup lang="ts">
import { Form, Head, setLayoutProps, usePage } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { useTranslations } from '@/composables/useTranslations';
import { wfArgs } from '@/lib/wayfinderArgs';
import { login } from '@/routes';
import { email } from '@/routes/password';

defineProps<{
    status?: string;
}>();

const page = usePage<{ locale: string; url_route_defaults: Record<string, string> }>();

const { t } = useTranslations();

setLayoutProps({
    title: t('website.auth.forgot_password.layout_title'),
    description: t('website.auth.forgot_password.layout_description'),
});
</script>

<template>
    <Head :title="t('website.auth.forgot_password.head_title')" />

    <div
        v-if="status"
        class="mb-4 text-center text-sm font-medium text-green-600"
    >
        {{ status }}
    </div>

    <div class="space-y-6">
        <Form v-bind="email.form(wfArgs(page))" v-slot="{ errors, processing }">
            <div class="grid gap-2">
                <Label for="email">{{ t('website.auth.forgot_password.email_label') }}</Label>
                <Input
                    id="email"
                    type="email"
                    name="email"
                    autocomplete="off"
                    autofocus
                    :placeholder="t('website.auth.forgot_password.email_placeholder')"
                />
                <InputError :message="errors.email" />
            </div>

            <div class="my-6 flex items-center justify-start">
                <Button
                    class="w-full"
                    :disabled="processing"
                    data-test="email-password-reset-link-button"
                >
                    <Spinner v-if="processing" />
                    {{ t('website.auth.forgot_password.submit') }}
                </Button>
            </div>
        </Form>

        <div class="space-x-1 text-center text-sm text-muted-foreground">
            <span>{{ t('website.auth.forgot_password.or_return') }}</span>
            <TextLink :href="login(wfArgs(page))">{{ t('website.auth.forgot_password.log_in') }}</TextLink>
        </div>
    </div>
</template>
