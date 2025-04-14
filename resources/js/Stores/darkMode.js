import { defineStore } from 'pinia'
import { ref, onMounted } from 'vue'

export const useDarkModeStore = defineStore('darkMode', () => {
  const isEnabled = ref(false)

  // Cek localStorage saat komponen dimuat
  onMounted(() => {
    if (typeof localStorage !== 'undefined') {
      const storedDarkMode = localStorage.getItem('darkMode')
      if (storedDarkMode === '1') {
        isEnabled.value = true
      } else if (storedDarkMode === '0') {
        isEnabled.value = false
      } else {
        // Jika tidak ada preferensi yang disimpan, set default ke dark mode
        isEnabled.value = true
      }

      // Atur mode setelah pengecekan
      set(isEnabled.value)
    }
  })

  function set(payload = null) {
    isEnabled.value = payload !== null ? payload : !isEnabled.value

    if (typeof document !== 'undefined') {
      document.body.classList[isEnabled.value ? 'add' : 'remove']('dark-scrollbars')

      document.documentElement.classList[isEnabled.value ? 'add' : 'remove'](
        'dark',
        'dark-scrollbars-compat',
      )
    }

    // Simpan preferensi ke localStorage
    if (typeof localStorage !== 'undefined') {
      localStorage.setItem('darkMode', isEnabled.value ? '1' : '0')
    }
  }

  return {
    isEnabled,
    set,
  }
})