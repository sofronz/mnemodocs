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
      route: 'dashboard.index',
      icon: mdiMonitor,
      label: 'Dashboard',
    },
    ...(isAdmin ? [
      {
        route: 'users.index',
        label: 'Users',
        icon: mdiAccountGroup,
      },
      {
        route: 'roles.index',
        label: 'Roles',
        icon: mdiViewList,
      },
    ] : []),
    {
      route: 'documents.index',
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