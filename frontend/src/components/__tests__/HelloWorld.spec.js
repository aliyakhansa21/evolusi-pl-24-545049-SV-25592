import { describe, it, expect } from 'vitest'

// Fungsi logika sederhana untuk memformat status tugas
function formatTaskLabel(title, isCompleted) {
  return isCompleted ? `[SELESAI] ${title}` : `[BELUM] ${title}`
}

describe('Task Logic Unit Test', () => {
  it('memformat label tugas yang sudah selesai dengan benar', () => {
    const hasil = formatTaskLabel('Belajar Vue CI/CD', true)
    expect(hasil).toBe('[SELESAI] Belajar Vue CI/CD')
  })

  it('memformat label tugas yang belum selesai dengan benar', () => {
    const hasil = formatTaskLabel('Setup GitHub Actions', false)
    expect(hasil).toBe('[BELUM] Setup GitHub Actions')
  })
})