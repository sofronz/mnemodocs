import {
  mdiAccountGroup,
  mdiMonitor,
  mdiViewList,
  mdiFileDocumentCheckOutline,
  mdiPalette,
  mdiImageArea,
} from '@mdi/js'


export default function menuAside(isAdmin) {
  const menuItems = [
    {
      route: 'dashboard',
      icon: mdiMonitor,
      label: 'Dashboard',
    },
    {
      route: 'roles.index',
      label: 'Roles',
      icon: mdiViewList,
    },
    ...(isAdmin ? [
      {
        route: 'users.index',
        label: 'Users',
        icon: mdiAccountGroup,
      }
    ] : []),
    {
      route: 'dashboard',
      label: 'Documents',
      icon: mdiFileDocumentCheckOutline,
    },
    {
      route: 'categories.index',
      label: 'Categories',
      icon: mdiPalette,
    },
    // {
    //   route: 'dashboard',
    //   label: 'Media',
    //   icon: mdiImageArea,
    // },
    // Tambahkan menu lainnya jika diperlukan
  ];

  return menuItems;
}