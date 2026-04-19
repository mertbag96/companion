<script setup lang="ts">
import { Form, Head, setLayoutProps, usePage } from '@inertiajs/vue3';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Spinner } from '@/components/ui/spinner';
import { useTranslations } from '@/composables/useTranslations';
import { wfArgs } from '@/lib/wayfinderArgs';
import { logout } from '@/routes';
import { send } from '@/routes/verification';

defineProps<{
    status?: string;
}>();

const page = usePage<{ locale: string; url_route_defaults: Record<string, string> }>();

const { t } = useTranslations();

setLayoutProps({
    title: t('website.auth.verify_email.layout_title'),
    description: t('website.auth.verify_email.layout_description'),
});
</script>

<template>
    <Head :title="t('website.auth.verify_email.head_title')" />

    <div
        v-if="status === 'verification-link-sent'"
        class="mb-4 text-center text-sm font-medium text-green-600"
    >
        {{ t('website.auth.verify_email.verification_sent') }}
    </div>

    <Form
        v-bind="send.form(wfArgs(page))"
        class="space-y-6 text-center"
        v-slot="{ processing }"
    >
        <Button :disabled="processing" variant="secondary">
            <Spinner v-if="processing" />
            {{ t('website.auth.verify_email.resend') }}
        </Button>

        <TextLink :href="logout(wfArgs(page))" as="button" class="mx-auto block text-sm">
            {{ t('website.auth.verify_email.log_out') }}
        </TextLink>
    </Form>
</template>
