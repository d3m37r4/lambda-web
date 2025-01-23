import { trans } from 'laravel-vue-i18n';

export const getRoleName = (role, separator = '-') => {
    if (!role?.name) {
        return trans('role.name.unknown');
    }

    const formattedRoleName = role.name.toLowerCase().replace(/\s+/g, separator);
    const translation = trans(`role.name.${formattedRoleName}`);

    return translation === `role.name.${formattedRoleName}` ? role.name : translation;
};
